<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class WriterController extends ModuleController
{
    protected $moduleName = 'writers';

    protected $titleColumnKey = 'name';

    protected $indexOptions = [
    ];

    protected $indexColumns = [
        'name' => [
            'title' => 'Name',
            'field' => 'name'
        ],
        'role' => [
            'title' => 'Role',
            'field' => 'role'
        ]
    ];
}
