<?php

use Astrogoat\Blog\Http\Controllers\ArticleController;
use Astrogoat\Blog\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'blog.article.',
    'prefix' => 'blog/article/',
//    'middleware' => ['enabled:Astrogoat\Blog\Settings\BlogSettings']
], function () {
    Route::get('{article:slug}', [ArticleController::class, 'show'])->name('show');
});

Route::group([
    'as' => 'blog.category.',
    'prefix' => 'blog/category/',
//    'middleware' => ['enabled:Astrogoat\Blog\Settings\BlogSettings']
], function () {
    Route::get('{category:slug}', [CategoryController::class, 'show'])->name('show');
});
