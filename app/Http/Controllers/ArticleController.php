<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Issue;
use App\Models\Section;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    protected $settingsController;

    public function __construct(SettingsController $settings)
    {
        $this->settingsController = $settings;
    }

    public function show($issue, $section, $slug)
    {
        $issue = Issue::forSlug($issue)->scopes(['published', 'visible'])->firstOrFail();
        $section = Section::forSlug($section)->firstOrFail();
        $article = Article::forSlug($slug)
            ->scopes(['published', 'visible'])
            ->where('issue_id', $issue->id)
            ->where('section_id', $section->id)
            ->firstOrFail();
        return $this->showCore($issue, $section, $article);
    }

    public function showIssueless($section, $slug)
    {
        $section = Section::forSlug($section)->firstOrFail();
        $article = Article::forSlug($slug)
            ->scopes(['published', 'visible'])
            ->where('section_id', $section->id)
            ->firstOrFail();

        return $this->showCore(null, $section, $article);
    }

    public function trackView($articleId)
    {
        ArticleView::createViewRecord($articleId);
        return response(base64_decode('R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs='))
            ->header('Content-Type', 'image/gif');
    }

    protected function showCore($issue, $section, $article)
    {
        $top = app(ArticleRepository::class)
            ->getTopStories()
            ->reject(function ($item) use ($article) {
                return $item->id == $article->id;
            });

        return view('layouts.article', [
            'article' => $article,
            'issue' => $issue,
            'section' => $section,
            'sections' => Section::current()->ordered()->get(),
            'aboutSection' => Section::forSlug('about')->first(),
            'topStories' => $top,
            'continueReading' => $this->getContinueReading($issue, $article, $section, $top),
            'look' => $this->settingsController->lookAndFeel(),
        ]);
    }

    protected function getContinueReading(
        ?Issue $issue,
        Article $article,
        Section $section,
        $top
    ) {
        if (!$issue) {
            return [];
        }

        $need = 3;
        $topMap = $top->mapWithKeys(function ($item) {
            return [$item->id => true];
        });
        $isTop = function ($item) use ($topMap) {
            return isset($topMap[$item->id]);
        };

        $nextInSection = $article->where('issue_id', $issue->id)
            ->where('section_id', $section->id)
            ->where('position', '>', $article->position)
            ->published()
            ->orderBy('position')
            ->get();


        $interestingNext = $nextInSection->reject($isTop)->take($need);

        for (
            $i = 0, $nextSection = $section->next();
            $i < 6 && count($interestingNext) < $need && $nextSection != null;
            $i++, $nextSection = $nextSection->next()
        ) {
            $articles = Article::where('issue_id', $issue->id)
                ->where('section_id', $nextSection->id)
                ->published()
                ->orderBy('position')
                ->limit($need - count($interestingNext))
                ->get();

            $interestingNext = $interestingNext->concat(
                $articles->reject($isTop)
            );
        }

        return $interestingNext;
    }
}
