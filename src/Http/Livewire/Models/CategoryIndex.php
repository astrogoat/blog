<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Category;
use Helix\Lego\Http\Livewire\Models\Index;

class CategoryIndex extends Index
{
    public function model(): string
    {
        return Category::class;
    }

    public function columns(): array
    {
        return [
            'name' => 'Name',
            'updated_at' => 'Last updated',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'name';
    }

    public function render()
    {
        return view('blog::models.blog.categories.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
