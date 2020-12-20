<?php

namespace App\Http\Controllers\Admin;

class WriterController extends GatedModuleController
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
