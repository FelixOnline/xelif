<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Section extends Model implements Sortable
{
    use HasSlug, HasPosition;

    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
        'current',
        'featured',
        'colour',
        'email',
    ];

    public $slugAttributes = [
        'title',
    ];

    public function writers()
    {
        return $this->belongsToMany(\App\Models\Writer::class);
    }

    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    public function link($page = null)
    {
        return route('section' . ($page ? ".page" : ""),
                        [$this->getSlug(), $page]);
    }

    public function next()
    {
        return Section::where('position', '>', $this->position)
                        ->where('id', '!=', $this->id)
                        ->where('current', 1)
                        ->first();
    }

    public function scopeCurrent($query)
    {
        return $query->where('current', 1);
    }

    public function loadArticleCount()
    {
        $this->load(['articles_count' => function($q) {
            $q->scopes(['published', 'visiuble']);
        }]);
    }
}
