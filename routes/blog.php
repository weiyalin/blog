<?php

Route::group(['prefix' => 'article'], function () {
    Route::post("cover_upload", 'Blog\ArticleController@upload');
    Route::get("cover_img", 'Blog\ArticleController@download_img');
    Route::post("create", 'Blog\ArticleController@create');

    Route::post("getArticleList", 'Blog\ArticleController@getArticleList');

    Route::get("getTag", 'Blog\TagController@getTag');
    Route::get("getTagList", 'Blog\TagController@getTagList');
    Route::post("deleteTag", 'Blog\TagController@deleteTag');
    Route::post("addTag", 'Blog\TagController@addTag');
});