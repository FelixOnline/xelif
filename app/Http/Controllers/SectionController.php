<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Section;

class SectionController extends Controller
{
    protected $settingsController;

    protected $articlesPerPage = 16;

    public function __construct(SettingsController $settings)
    {
        $this->settingsController = $settings;
    }

    public function show($sectionSlug, $page = null)
    {
        if ($sectionSlug === "puzzles") {
            return app(PuzzleSectionController::class)->show();
        }

        $section = Section::forSlug($sectionSlug)->firstOrFail();

        $numPages = (int)ceil($this->getArticleCount($section) / $this->articlesPerPage);

        return view('layouts.section', [
            'section' => $section,
            'sections' => Section::current()->exceptForTitle('About')->ordered()->get(),
            'aboutSection' => Section::forTitle('About')->first(),
            'articles' => $this->getArticles($section, $page),
            'page' => $page ?? 1,
            'numPages' => $numPages,
            'look' => $this->settingsController->lookAndFeel(),
        ]);
    }

    protected function getArticles(Section $section, $page)
    {
        $articles = $this->getArticlesQueryStub($section);

        if ($page) {
            $articles->offset(($page - 1) * $this->articlesPerPage);
        }

        return $articles->with('writers')->limit($this->articlesPerPage)->get();
    }

    protected function getArticlesQueryStub(Section $section)
    {
        return Article::where('section_id', $section->id)
            ->scopes(['published', 'visible'])->ordered();
    }

    protected function getArticleCount(Section $section)
    {
        $section->loadCount('articles');
        return $section->articles_count;
    }
}
