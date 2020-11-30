<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class ArticleController extends ModuleController
{
    public function __construct(\App\Http\Controllers\SettingsController $settings,
                                Application $app,
                                Request $request)
    {
        parent::__construct($app, $request);
        $this->settings = $settings;
    }

    protected $settings;

    protected $moduleName = 'articles';

    protected $titleColumnKey = 'headline';

    protected $indexOptions = [
        'reorder' => true,
    ];

    protected $indexColumns = [
        'headline' => [
            'title' => 'Headline',
            'field' => 'headline',
        ],
        'section' => [
            'title' => 'Section',
            'relationship' => 'section',
            'field' => 'title',
            'sort' => true,
        ],
        'issue' => [
            'title' => 'Issue',
            'relationship' => 'issue',
            'field' => 'issue',
        ]
    ];

    protected $filters = [
        'issue' => 'issue_id',
    ];

    protected $filtersDefaultOptions = ['issue' => -1];

    protected function previewData($item)
    {
        return [
            'article' => $item,
            'section' => $item->section,
            'look' => $this->settings->lookAndFeel(),
            'issue' => $item->issue,
            'continueReading' => [],
            'topStories' => [],
            'sections' => [],
            'aboutSection' => \App\Models\Section::forSlug('about')->first(),
        ];
    }

    protected function formData($request)
    {
        return [
            'sections' => app()->make(\App\Repositories\SectionRepository::class)->listAll(),
            'issues' => app()->make(\App\Repositories\IssueRepository::class)->listAll('issue'),
        ];
    }

    protected function indexData($request)
    {
        return [
            'issueList' => array_merge(
            [
                ['value' => 0, 'label' => 'Cross-site'],
                ['value' => -1, 'label' => 'Latest Issue'],
            ],
            $this->getIssueFilterEntries()),
        ];
    }

    protected function getIssueFilterEntries() : Array
    {
        return app(\App\Repositories\IssueRepository::class)
                ->listAllForceOrder('issue', ['issue' => 'DESC'])
                ->map(function($value, $key) {
                    return ['value' => $key, 'label' => "Issue $value"];
                })
                ->toArray();
    }
}
