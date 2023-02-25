<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\Controller;
use App\Models\Article;
use App\Models\ArticleView;
use Carbon\Carbon;

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

    public function export($article_id) {
        $slug = Article::find($article_id)->slug;
        $views = ArticleView::where('article_id', $article_id)->get();

        return response()->streamDownload(function () use ($views) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['created_at', 'user_agent', 'referer']);
            foreach ($views as $view) {
                fputcsv($out, [$view->created_at, $view->user_agent, $view->referer]);
            }
            fclose($out);
        }, "$slug.csv");
    }

}
