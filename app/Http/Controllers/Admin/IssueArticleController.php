<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\SettingsController;
use App\Models\Issue;
use App\Models\Section;
use App\Repositories\IssueRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class IssueArticleController extends GatedModuleController
{
    public function __construct(
        SettingsController $settings,
        Application $app,
        Request $request
    ) {
        parent::__construct($app, $request);
        $this->settings = $settings;
    }

    protected $settings;

    protected $moduleName = 'issues.articles';

    protected $modelName = 'Article';

    protected $titleColumnKey = 'headline';

    protected $indexOptions = [
        'reorder' => true,
    ];

    private const LATEST_ISSUE_FILTER_VALUE = -1;

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

    protected $filtersDefaultOptions = ['issue' => self::LATEST_ISSUE_FILTER_VALUE];

    // For nested module https://twill.io/docs/crud-modules/nested-modules.html#parent-child-modules
    protected function getParentModuleForeignKey()
    {
        return 'issue_id';
    }

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
            'aboutSection' => Section::forTitle('About')->first(),
        ];
    }

    protected function formData($request)
    {
        $issue = app(IssueRepository::class)->getById(request('issue'));
        return [
            'sections' => app()->make(\App\Repositories\SectionRepository::class)->listAll(),
            'issues' => app()->make(IssueRepository::class)->listAll('issue')->sortDesc(),
            'editableTitle' => false,
            'breadcrumb' => [
                [
                    'label' => 'Issues',
                    'url' => moduleRoute('issues', '', 'index'),
                ],
                [
                    'label' => $issue->issue,
                    'url' => moduleRoute('issues', '', 'edit', $issue->id),
                ],
                [
                    'label' => 'Articles',
                    'url' => moduleRoute('issues.articles', '', 'index'),
                ],
                [
                    'label' => 'Edit',
                ],
            ],
        ];
    }

    protected function indexData($request)
    {
        $issue = app(IssueRepository::class)->getById(request('issue'));
        return [
            'issueList' => array_merge(
                [
                    ['value' => 0, 'label' => 'Cross-site'],
                    ['value' => self::LATEST_ISSUE_FILTER_VALUE, 'label' => 'Latest Issue'],
                ],
                $this->getIssueFilterEntries()
            ),
            'breadcrumb' => [
                [
                    'label' => 'Issues',
                    'url' => moduleRoute('issues', '', 'index'),
                ],
                [
                    'label' => $issue->issue,
                    'url' => moduleRoute('issues', '', 'edit', $issue->id),
                ],
                [
                    'label' => 'Articles',
                ],
            ],
        ];
    }

    protected function getIssueFilterEntries(): array
    {
        return app(IssueRepository::class)
            ->listAllForceOrder('issue', ['issue' => 'DESC'])
            ->map(function ($value, $key) {
                return ['value' => $key, 'label' => "Issue $value"];
            })
            ->toArray();
    }

    protected function filterScope($prepend = [])
    {
        $scope = parent::filterScope($prepend);
        if ($scope['issue_id'] == self::LATEST_ISSUE_FILTER_VALUE) {
            // here we translate it to the actual latest issue id
            $scope['issue_id'] = app(IssueRepository::class)
                ->order(Issue::query(), ['issue' => 'DESC'])
                ->first()
                ->id;
        }
        return $scope;
    }

}
