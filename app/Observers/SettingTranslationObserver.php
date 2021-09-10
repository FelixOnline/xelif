<?php

namespace App\Observers;

use A17\Twill\Models\Translations\SettingTranslation;

class SettingTranslationObserver
{
    public function saving(SettingTranslation $model)
    {
        // sigh, why is so much software this shit
        if (is_array($model->value)) {
            $model->value = current($model->value);
        }
    }
}
