<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class PuzzleTeamController extends GatedModuleController
{
    protected $moduleName = 'puzzleTeams';
    protected $indexOptions = [
        'publish' => false
    ];
    protected $titleColumnKey = 'name';

    protected $indexColumns = [
        'name' => [
            'title' => 'Name',
            'field' => 'name'
        ],
        'role' => [
            'title' => 'Points',
            'field' => 'points'
        ]
    ];
}
