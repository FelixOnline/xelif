<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    protected $table = "article_views";

    protected $fillable = [
        'article_id',
        'ip',
        'user_agent',
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
        ArticleView::create([
            'article_id' => $articleId,
            'ip' => \Request::getClientIp(),
            'user_agent' => \Request::header('User-Agent'),
        ]);
    }
}
