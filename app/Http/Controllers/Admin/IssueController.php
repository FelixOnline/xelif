<?php

namespace App\Http\Controllers\Admin;

class IssueController extends GatedModuleController
{
    protected $moduleName = 'issues';

    protected $titleColumnKey = 'issue';

    protected $titleFormKey = 'issue';

    protected $indexColumns = [
        'issue' => [
            'title' => 'Issue',
            'field' => 'issue',
        ],
        'publish' => [
            'title' => 'Publish On',
            'field' => 'publish_start_date'
        ],
        'articles' => [
            'title' => 'Articles',
            'nested' => 'articles'
        ]
    ];
}
