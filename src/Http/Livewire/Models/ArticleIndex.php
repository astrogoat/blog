<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Article;
use Helix\Lego\Models\Page;
use Helix\Lego\Http\Livewire\Models\Index;

class ArticleIndex extends Index
{
    public function model() : string
    {
        return Article::class;
    }

    public function columns() : array
    {
        return [
            'title' => 'Title',
            'category' => 'Category',
            'author' => 'Author',
            'updated_at' => 'Last updated',
        ];
    }

    public function mainSearchColumn() : string|false
    {
        return 'title';
    }

    public function scopeCategory($query, $value)
    {
        return $query->whereHas('category', function ($query) use ($value) {
            $query->where('name', 'LIKE', '%' . $value . '%');
        });
    }

    public function orderByCategory($query, $sortDirection)
    {
        return $query
            ->join('blog_categories', 'blog_categories.id', '=', 'blog_articles.category_id')
            ->orderBy('blog_categories.name', $sortDirection);
    }

    public function render()
    {
        return view('blog::models.blog.articles.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
