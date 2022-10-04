<?php

use Astrogoat\Blog\Http\Controllers\ArticlesController;
use Astrogoat\Blog\Http\Controllers\CategoriesController;
use Astrogoat\Blog\Http\Controllers\BlogController;
use Astrogoat\Blog\Http\Controllers\TagsController;
use Astrogoat\Blog\Http\Livewire\Models\ArticleForm;
use Astrogoat\Blog\Http\Livewire\Models\ArticleIndex;
use Astrogoat\Blog\Http\Livewire\Models\CategoryForm;
use Astrogoat\Blog\Http\Livewire\Models\CategoryIndex;
use Astrogoat\Blog\Http\Livewire\Models\TagForm;
use Astrogoat\Blog\Http\Livewire\Models\TagIndex;
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
        Route::get('/', ArticleIndex::class)->name('index');
        Route::get('/create', ArticleForm::class)->name('create');
        Route::get('/{article}/edit', ArticleForm::class)->name('edit');
        Route::get('/{article}/editor/{editor_view?}', [ArticlesController::class, 'editor'])->name('editor');
    });

    Route::group([
        'as' => 'categories.',
        'prefix' => 'categories/'
    ], function () {
        Route::get('/', CategoryIndex::class)->name('index');
        Route::get('/create', CategoryForm::class)->name('create');
        Route::get('/{category}/edit', CategoryForm::class)->name('edit');
        Route::get('/{category}/editor/{editor_view?}', [CategoriesController::class, 'editor'])->name('editor');
    });

    Route::group([
        'as' => 'tags.',
        'prefix' => 'tags/'
    ], function () {
        Route::get('/', TagIndex::class)->name('index');
        Route::get('/create', TagForm::class)->name('create');
        Route::get('/{tag}/edit', TagForm::class)->name('edit');
    });
});
