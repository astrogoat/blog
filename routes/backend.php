<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'blog.article.',
    'prefix' => 'blog/articles'
], function () {
    Route::get('/', [\Astrogoat\Blog\Http\Controllers\ArticleController::class, 'index'])->name('index');
    Route::get('/create', [\Astrogoat\Blog\Http\Controllers\ArticleController::class, 'create'])->name('create');
    Route::get('/{articles}/edit', [\Astrogoat\Blog\Http\Controllers\ArticleController::class, 'edit'])->name('edit');
    Route::get('/{articles}/editor/{editor_view?}', [\Blog\Locations\Http\Controllers\ArticleController::class, 'editor'])->name('editor');
});
