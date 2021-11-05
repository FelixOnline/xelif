<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IssueController::class, 'show'])
    ->name('home');

Route::get('/puzzles', [\App\Http\Controllers\PuzzleLeaderboardController::class, 'show'])
    ->name('puzzles');

Route::get('/issue/{id}', [\App\Http\Controllers\IssueController::class, 'show'])
    ->name('issue');

Route::get('/issue/{issue}/{section}/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])
    ->name('article');

Route::get('/_v/{id}', [\App\Http\Controllers\ArticleController::class, 'trackView'])
    ->name('article.track');

Route::get('/section/{name}/page/{page}', [\App\Http\Controllers\SectionController::class, 'show'])
    ->name('section.page');

Route::get('/section/{section}/{slug}', [\App\Http\Controllers\ArticleController::class, 'showIssueless'])
    ->name('article.issueless');

Route::get('/section/{name}', [\App\Http\Controllers\SectionController::class, 'show'])
    ->name('section');

$v2_paths = [
    'articles', 'arts', 'authors', 'biz', 'books', 'cands', 'categories', 'comment',
    'culture', 'categories', 'editorial', 'fashion', 'features', 'film', 'food', 'frontpage', 'games',
    'highlights', 'images', 'issues', 'millenials', 'music', 'news', 'phoenix', 'politics',
    'publications', 'science', 'sex', 'sport', 'tags', 'tech', 'travel', 'tv', 'welfare'
];

$v2_path_regex = "(" . implode('|', $v2_paths) . ")/.*";

if (getenv('FELIX_V2_LINK')){
    Route::get('/{old_path}', function($old_path) {
        return redirect(env('FELIX_V2_LINK')."/". $old_path);
    })->where('old_path', $v2_path_regex);
}
