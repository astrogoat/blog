<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Group;
use Helix\Lego\Http\Livewire\Models\Form;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Helix\Lego\Models\Model;

class GroupForm extends Form
{
    public Group $group;
    public Collection $selectedArticles;
    public array $selectedArticlesIds = [];

    protected $listeners = [
        'updateProductsOrder',
    ];

    public function rules()
    {
        return [
            'group.title' => 'required',
        ];
    }

    public function mounted()
    {
        $this->selectedArticles = $this->group->articles;
        $this->selectedArticlesIds = $this->selectedArticles->map(fn ($article) => $article->id)->toArray();
    }

    public function saving()
    {
        $this->group->articles()->sync(
            $this->selectedArticles->mapWithKeys(fn ($product, $index) => [$product->id => ['order' => $index]])
        );
    }

    public function saved()
    {
        if ($this->group->wasRecentlyCreated) {
            return redirect()->to(route('lego.blog.groups.edit', $this->group));
        }
    }

    public function updating($property, $value)
    {
        parent::updating($property, $value);
    }

    public function updated($property, $value)
    {
        parent::updated($property, $value);
    }

    protected function getArticlesForGroupCombobox() : array
    {
        return Article::all()->map(fn (Article $article) => [
            'key' => $article->id,
            'value' => $article->title,
            'selected' => in_array($article->id, $this->selectedArticlesIds),
        ])->toArray();
    }

    public function selectArticle($articleId)
    {
        $this->selectedArticlesIds[] = $articleId;
        $this->selectedArticles->push(Article::find($articleId));
        $this->markAsDirty();
    }

    public function unselectArticle($articleId)
    {
        $this->selectedArticlesIds = array_filter($this->selectedArticlesIds, fn ($id) => $id !== $articleId);
        $this->selectedArticles = $this->selectedArticles->reject(fn ($product) => $product->id === $articleId);
        $this->emitTo('fab.forms.combobox', 'updateItems', $this->getArticlesForGroupCombobox());
        $this->markAsDirty();
    }

    public function updateArticlesOrder($order)
    {
        $this->selectedArticles = $this->selectedArticles
            ->sort(function ($a, $b) use ($order) {
                $positionA = array_search($a->id, $order);
                $positionB = array_search($b->id, $order);

                return $positionA - $positionB;
            })
            ->values();

        $this->markAsDirty();
    }

    public function deleting()
    {
        $this->group->delete();
    }

    public function deleted()
    {
        return redirect()->to(route('lego.blog.index'));
    }

    public function render()
    {
        return view('blog::models.blog.groups.form');
    }

    public function getModel(): Model
    {
        return $this->group;
    }
}
