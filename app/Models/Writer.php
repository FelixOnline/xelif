<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;

class Writer extends Model
{
    use HasSlug, HasMedias;

    protected $fillable = [
        'published',
        'name',
        'role',
        'bio',
        'current',
    ];

    public $slugAttributes = [
        'name',
    ];

    public $mediasParams = [
        'cover' => [
            'desktop' => [
                [
                    'name' => 'desktop',
                    'ratio' => 16 / 9,
                ],
            ],
            'mobile' => [
                [
                    'name' => 'mobile',
                    'ratio' => 1,
                ],
            ],
            'flexible' => [
                [
                    'name' => 'free',
                    'ratio' => 0,
                ],
                [
                    'name' => 'landscape',
                    'ratio' => 16 / 9,
                ],
                [
                    'name' => 'portrait',
                    'ratio' => 3 / 5,
                ],
            ],
        ],
    ];

    public function sections()
    {
        return $this->belongsToMany(\App\Models\Section::class);
    }

    public function nameFormatted()
    {
        return str_replace(" ", "&nbsp;", htmlspecialchars($this->name));
    }
}
