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

    /**
     * Gets a set of articles in this issue, or potentially from prior issues, in
     * a given section slug.
     *
     * @param string $section The section slug for which to get articles.
     * @param int|null $begin The number of articles to skip from the beginning
     *                          of the section in this issue in the returned
     *                          set of articles.
     * @param int|null $count The number of articles to be returned.
     * @param bool|int $fillBreak If an integer, fills the number of returned
     *                              articles up to the next multiple of this
     *                              number using articles from prior issues in this
     *                              category. If TRUE, gets the value for this
     *                              parameter from the value of $count, which
     *                              must not be null. If FALSE, no bulking with prior
     *                              issue articles will be performed.
     */
    public function articleRange($section,
                                    $begin = null,
                                    $count = null,
                                    $fillBreak = false)
    {
        $this->buildArticleLookupFromSlug($section);

        if (!isset($this->articleLookup[$section]))
            return [];

        $collection = $this->articleLookup[$section];

        if ($begin)
            $collection = $collection->skip($begin);

        if ($count != null)
            $collection = $collection->take($count);

        if ($fillBreak === true)
            $fillBreak = $count;

        if ($fillBreak)
        {
            $rem = count($collection) % $fillBreak;
            if ($rem != 0)
            {
                $needed = $fillBreak - $rem;

                $additionalArticles =
                    app(\App\Repositories\ArticleRepository::class)
                        ->getAdditionalArticles($this, Section::forSlug($section)->first(), $needed);

                $collection = $collection->concat($additionalArticles);
            }
        }

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
