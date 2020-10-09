<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class SectionController extends ModuleController
{
    protected $moduleName = 'sections';

    protected $indexOptions = [
        'reorder' => true,
        'feature' => true,
        'bulkFeature' => true,
    ];

    protected function formData($request)
    {
        return [
        ];
    }
}
