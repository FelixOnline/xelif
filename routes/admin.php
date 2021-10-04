<?php

Route::module('articles');
Route::module('issues');
Route::module('sections');
Route::module('writers');

Route::name('uploader')->get('/articleUpload', 'ArticleUploadController@show');
Route::name('uploader.save')->post('/articleUpload/save', 'ArticleUploadController@save');