<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class IssueController extends ModuleController
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
    ];
}
