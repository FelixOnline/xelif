<?php

use App\Http\Controllers\SettingsController;
use App\Models\Section;

if (!function_exists("coreData")) {
    // Data required by layouts.core
    function coreData(SettingsController $settingsController): array
    {
        return [
            'look' => $settingsController->lookAndFeel(),
            'aboutSection' => Section::forTitle('About')->first(),
        ];
    }
}
