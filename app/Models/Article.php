<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements Sortable
{
    use HasBlocks, HasSlug, HasMedias, HasRevisions, HasPosition, HasFactory;

    protected $fillable = [
        'published',
        'headline',
        'lede',
        'position',
        'publish_start_date',
        'publish_end_date',
        'section_id',
        'issue_id',
    ];

    public $slugAttributes = [
        'headline',
    ];

    public $mediasParams = [
        'main' => [
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
        'thumbnail' => [
            'fixed' => [
                [
                    'name' => 'landscape',
                    'ratio' => 4 / 3,
                ],
                [
                    'name' => 'portrait (posters & covers only)',
                    'ratio' => 3 / 5,
                ],
            ],
        ]
    ];

    // Articles are almost always fetched these models
    protected $with = ['section', 'issue', 'slugs', 'medias'];

    public function writers()
    {
        return $this->belongsToMany(\App\Models\Writer::class);
    }

    public function section()
    {
        return $this->belongsTo(\App\Models\Section::class);
    }

    public function issue()
    {
        return $this->belongsTo(\App\Models\Issue::class);
    }

    public function link()
    {
        if (!$this->issue) {
            return route('article.issueless', [
                'slug' => $this->getSlug(),
                'section' => $this->section->getSlug(),
            ]);
        }

        return route('article', [
            'slug' => $this->getSlug(),
            'section' => $this->section->getSlug(),
            'issue' => $this->issue->getSlug(),
        ]);
    }

    public static function inBucket($bucketKey)
    {
        return Article::with([
            'buckets' => function ($q) {
                $q->orderBy('position');
            }
        ])->whereHas('buckets', function ($q) use ($bucketKey) {
            $q->where('bucket_key', $bucketKey);
        })->get();
    }

    public function buckets()
    {
        return $this->morphMany(\A17\Twill\Models\Feature::class, 'featured');
    }

    public function scopePublished($query)
    {
        if (!$this->issue) {
            return parent::scopePublished($query);
        } else {
            return parent::scopePublished($query)->whereHas('issue', function ($q) {
                $q->published();
            });
        }
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc(
            Issue::select('issue')->whereColumn('id', 'articles.issue_id')
        )->orderBy('position');
    }

    public function getTitleInBucketAttribute()
    {
        return $this->section->title . ": " . $this->headline;
    }
}
