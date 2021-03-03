<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use A17\Twill\Models\Setting;

class SettingsController extends Controller
{
    protected $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function lookAndFeel()
    {
        return $this->getSettingsSectionValues('look-and-feel');
    }

    protected function getSettingsSectionValues($sectionName)
    {
        // with('translations') here is to avoid the N+1 problem as access to $setting->value requires a query
        // to setting_translations table
        return  $this->repository->where('section', $sectionName)->with('translations')->get()
                     ->mapWithKeys(function(Setting $setting) {
                         return [$setting->key => $setting->value];
                     });
    }
}
