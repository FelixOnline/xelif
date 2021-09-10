<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    protected $table = "article_views";

    protected $fillable = [
        'article_id',
        'user_agent',
        'referer'
    ];

    public function article()
    {
        return $this->belongsTo(\App\Models\Article::class);
    }

    public function setUpdatedAtAttribute()
    {
    }

    public static function createViewRecord($articleId)
    {
        if (!\Crawler::isCrawler()) {
            ArticleView::create([
                'article_id' => $articleId,
                'user_agent' => \Request::header('User-Agent'),
                'referer' => \Request::header('Referer')
            ]);
        }
    }
}
