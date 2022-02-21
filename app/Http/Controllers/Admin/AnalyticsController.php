<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\Controller;
use App\Models\Article;
use App\Models\ArticleView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    public function show()
    {
        $views = ArticleView::selectRaw('article_id, COUNT(*) as view_count')
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->groupBy('article_id');
        $articles = Article::joinSub($views, 'views', function ($join) {
            $join->on('articles.id','=', 'views.article_id');
        })->whereNotNull('view_count')
            ->where('published', 1)
            ->orderByDesc('view_count')->get();
        return view('admin.analytics.analytics', [
            'articles' => $articles
        ]);
    }

}