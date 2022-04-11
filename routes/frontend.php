<?php

use Astrogoat\Blog\Http\Controllers\ArticlesController;
use Astrogoat\Blog\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'blog.',
    'prefix' => 'blog/',
    'middleware' => ['enabled:Astrogoat\Blog\Settings\BlogSettings']
], function () {

    Route::group([
        'as' => 'articles.',
        'prefix' => 'articles/',
    ], function () {
        Route::get('{article:slug}', [ArticlesController::class, 'show'])->name('show');
    });

    Route::group([
        'as' => 'categories.',
        'prefix' => 'categories/',
    ], function () {
        Route::get('{category:slug}', [CategoriesController::class, 'show'])->name('show');
    });

});
