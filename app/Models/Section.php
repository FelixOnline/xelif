<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model implements Sortable
{
    use HasFactory, HasSlug, HasPosition;

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

    protected $with = ['slugs'];

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
        return route(
            'section' . ($page ? ".page" : ""),
            [$this->getSlug(), $page]
        );
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

    public function scopeForTitle($query, $title)
    {
        return $query->whereTitle($title);
    }

    public function scopeExceptForTitle($query, $title)
    {
        if (is_array($title)){
            return $query->whereNotIn('title', $title);
        } else {
            return $query->where('title', '!=', $title);
        }
    }

    public function loadArticleCount()
    {
        $this->load([
            'articles_count' => function ($q) {
                $q->scopes(['published', 'visible']);
            }
        ]);
    }
}
