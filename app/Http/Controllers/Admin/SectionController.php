<?php

namespace App\Http\Controllers\Admin;

class SectionController extends GatedModuleController
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
