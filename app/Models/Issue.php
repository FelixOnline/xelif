<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Issue extends Model implements Sortable
{
    use HasSlug, HasPosition;

    protected $fillable = [
        'published',
        'issue',
        'position',
        'publish_start_date',
        'publish_end_date',
    ];
    
    public $slugAttributes = [
        'issue',
    ];

    protected $articleLookup = [];

    public function article()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    public function maybeArticle($section, $index) : ?Article
    {
        $this->buildArticleLookupFromSlug($section);

        if (count($this->articleLookup[$section]) <= $index)
            return null;

        return $this->articleLookup[$section][$index];
    }

    public function articleRange($section, $begin = null, $count = null)
    {
        $this->buildArticleLookupFromSlug($section);

        if (!isset($this->articleLookup[$section]))
            return [];

        $collection = $this->articleLookup[$section];

        if ($begin)
            $collection = $collection->skip($begin - 1);

        if ($count != null)
            $collection = $collection->take($count);

        return $collection;
    }

    protected function buildArticleLookupFromSlug($sectionSlug)
    {
        if (!isset($this->articleLookup[$sectionSlug]))
            $this->articleLookup[$sectionSlug] = $this->buildArticleLookup(Section::forSlug($sectionSlug)->first());
    }

    protected function buildArticleLookup(Section $section)
    {
        return \App\applyPublishedCriteria($this->article())
                ->where('section_id', $section->id)
                ->orderBy('position')
                ->get();
    }
}
