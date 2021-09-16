<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Issue;
use App\Models\Section;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Cache;

class IssueController extends Controller
{
    protected $settingsController;

    public function __construct(SettingsController $settings)
    {
        $this->settingsController = $settings;
    }

    public function show($id = null)
    {
        $singleIssue = $id != null;
        $issue = $singleIssue
            ? $this->getPublished($id)
            : $this->getLatestPublished();
        $featured = $singleIssue ? null : Article::inBucket('featured')->first();

//        return Cache::rememberForever(self::buildCacheKey($id),
//                                function() use ($issue, $singleIssue)
//        {
        return view('layouts.issue', [
            'issue' => $issue,
            'sections' => Section::current()->ordered()->get(),
            'aboutSection' => Section::forSlug('about')->first(),
            'topStories' => app(ArticleRepository::class)->getTopStories(),
            'featured' => $featured,
            'look' => $this->settingsController->lookAndFeel(),
            'singleIssueView' => $singleIssue,
        ])->render();
//        });
    }

    public static function buildCacheKey(?int $targetIssueId): string
    {
        $targetIssueId = $targetIssueId ?? 0;
        return "issue.$targetIssueId";
    }

    public static function clearCacheAllIssues()
    {
        /* Yes this is lazy, but whilst using a file cache driver we can't
         * use a tagged cache which would be a better way of doing this. */
        Cache::flush();
    }

    public static function clearCache(int $issueId)
    {
        Cache::forget(self::buildCacheKey($issueId));

        /* We have to clear the cached non-single-issue too in case changes
         * from the target issue made it into the non-specific issue. */
        Cache::forget(self::buildCacheKey(null));
    }

    public function getLatestPublished(): Issue
    {
        return Issue::select('*')->published()->visible()->orderByDesc('issue')->firstOrFail();
    }

    public function getPublished($id): Issue
    {
        return Issue::where('issue', $id)->published()->visible()->firstOrFail();
    }
}
