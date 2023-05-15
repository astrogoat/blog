<?php

namespace Astrogoat\Blog\Http\Livewire\Overlays;

use Astrogoat\Blog\Models\Category;
use Helix\Lego\Http\Livewire\Modal;

class BrowseCategories extends Modal
{
    public string $categoryInputId;

    public string $query = '';

    public $categories = [];

    public function mount($categoryInputId)
    {
        $this->categoryInputId = $categoryInputId;
    }

    public function updatedQuery($query)
    {
        if (! $query) {
            return $this->categories = [];
        }

        $this->categories = Category::where(Category::getDisplayKeyName(), 'LIKE', "%{$query}%")
            ->get();
    }

    public function select($category)
    {
        $this->dispatchBrowserEvent($this->categoryInputId, $category);

        $this->closeModal();
    }

    public function render()
    {
        return view('blog::livewire.overlays.browse-categories');
    }
}
