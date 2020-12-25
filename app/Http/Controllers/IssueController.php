<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Issue;
use App\Models\Section;
use App\Models\Article;

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

        return view('layouts.issue', [
            'issue' => $issue,
            'sections' => Section::current()->get(),
            'aboutSection' => Section::forSlug('about')->first(),
            'topStories' => Article::inBucket('top_stories'),
            'look' => $this->settingsController->lookAndFeel(),
            'singleIssueView' => $singleIssue,
        ]);
    }

    public function getLatestPublished(): Issue
    {
        $query = Issue::select('*');
        return \App\applyPublishedCriteria($query)
                     ->orderByDesc('issue')->firstOrFail();
    }

    public function getPublished($id): Issue
    {
        $query = Issue::where('issue', $id);
        return \App\applyPublishedCriteria($query)->firstOrFail();
    }

}
