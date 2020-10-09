<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IssueController::class, 'show'])
    ->name('home');

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
