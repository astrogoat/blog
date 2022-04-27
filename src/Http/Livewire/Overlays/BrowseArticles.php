<?php

namespace Astrogoat\Blog\Http\Livewire\Overlays;

use Astrogoat\Blog\Models\Article;
use Helix\Lego\Http\Livewire\Modal;

class BrowseArticles extends Modal
{
    public string $articleInputId;

    public string $query = '';

    public $articles = [];

    public function mount($articleInputId)
    {
        $this->articleInputId = $articleInputId;
    }

    public function updatedQuery($query)
    {
        if (! $query) {
            return $this->articles = [];
        }

        $this->articles = Article::where(Article::getDisplayKeyName(), 'LIKE', "%{$query}%")
            ->orWhere(Article::getAuthorName(), 'LIKE', "%{$query}%")
            ->get();
    }

    public function select($article)
    {
        $this->dispatchBrowserEvent($this->articleInputId, $article);

        $this->closeModal();
    }

    public function render()
    {
        return view('blog::livewire.overlays.browse-articles');
    }
}
