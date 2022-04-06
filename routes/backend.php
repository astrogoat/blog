<?php

use Astrogoat\Blog\Http\Controllers\ArticleController;
use Astrogoat\Blog\Http\Controllers\CategoryController;
use Astrogoat\Blog\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'blog.',
    'prefix' => 'blog/'
], function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
});

Route::group([
    'as' => 'blog.article.',
    'prefix' => 'blog/articles/'
], function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/create', [ArticleController::class, 'create'])->name('create');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
    Route::get('/{article}/editor/{editor_view?}', [ArticleController::class, 'editor'])->name('editor');
});

Route::group([
    'as' => 'blog.category.',
    'prefix' => 'blog/categories/'
], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/{category}/editor/{editor_view?}', [CategoryController::class, 'editor'])->name('editor');
});
