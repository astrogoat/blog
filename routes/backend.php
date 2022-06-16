<?php

use Astrogoat\Blog\Http\Controllers\ArticlesController;
use Astrogoat\Blog\Http\Controllers\CategoriesController;
use Astrogoat\Blog\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'blog.',
    'prefix' => 'blog/'
], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');

    Route::group([
        'as' => 'articles.',
        'prefix' => 'articles/'
    ], function () {
        Route::get('/', [ArticlesController::class, 'index'])->name('index');
        Route::get('/create', [ArticlesController::class, 'create'])->name('create');
        Route::get('/{article}/edit', [ArticlesController::class, 'edit'])->name('edit');
        Route::get('/{article}/editor/{editor_view?}', [ArticlesController::class, 'editor'])->name('editor');
    });

    Route::group([
        'as' => 'categories.',
        'prefix' => 'categories/'
    ], function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/create', [CategoriesController::class, 'create'])->name('create');
        Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
        Route::get('/{category}/editor/{editor_view?}', [CategoriesController::class, 'editor'])->name('editor');
    });
});
