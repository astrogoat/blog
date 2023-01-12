<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Tag;
use Helix\Lego\Http\Livewire\Models\Index;

class TagIndex extends Index
{
    public function model(): string
    {
        return Tag::class;
    }

    public function columns(): array
    {
        return [
            'title' => 'Title',
            'updated_at' => 'Last updated',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'title';
    }

    public function render()
    {
        return view('blog::models.blog.tags.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
