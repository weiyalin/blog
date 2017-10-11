<?php

Route::group(['prefix' => 'article'], function () {
    Route::post("cover_upload", 'Article\CreateController@upload');
    Route::get("cover_img", 'Article\CreateController@download_img');
    Route::post("create", 'Article\CreateController@create');
});

