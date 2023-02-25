<?php

Route::module('issues.articles');
Route::module('issues');
Route::module('sections');
Route::module('writers');
Route::module('puzzleTeams');

Route::name('uploader')->get('/articleUpload', 'ArticleUploadController@show');
Route::name('uploader.save')->post('/articleUpload/save', 'ArticleUploadController@save');

Route::name('analytics')->get('/analytics', 'AnalyticsController@show');
Route::name('analytics.articleView')->get('/analytics/articleView/{id}', 'AnalyticsController@export');
