<?php

namespace App\Http\Controllers;

use App\Models\Issue;
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
        return  $this->repository->where('section', $sectionName)->get()
                     ->mapWithKeys(function(Setting $setting) {
                         return [$setting->key => $setting->value];
                     });
    }
}
