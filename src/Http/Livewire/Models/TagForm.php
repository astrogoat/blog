<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Tag;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Models\Model;
use Illuminate\Support\Collection;

class TagForm extends Form
{
    public Tag $tag;
    public Collection $selectedArticles;
    public array $selectedArticlesIds = [];

//    protected $listeners = [
//        'updateArticlesOrder',
//    ];

    public function rules()
    {
        return [
            'tag.title' => 'required',
        ];
    }

    public function mounted()
    {
        $this->selectedArticles = $this->tag->articles;
        $this->selectedArticlesIds = $this->selectedArticles->map(fn ($article) => $article->id)->toArray();
    }

    public function saving()
    {
        $this->tag->articles()->sync(
            $this->selectedArticles->mapWithKeys(fn ($article, $index) => [$article->id => ['order' => $index]])
        );
    }

    public function saved()
    {
        if ($this->tag->wasRecentlyCreated) {
            return redirect()->to(route('lego.blog.tags.edit', $this->tag));
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

    protected function getArticlesForTagCombobox(): array
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
        $this->selectedArticles = $this->selectedArticles->reject(fn ($article) => $article->id === $articleId);
        $this->emitTo('fab.forms.combobox', 'updateItems', $this->getArticlesForTagCombobox());
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
        $this->tag->delete();
    }

    public function deleted()
    {
        return redirect()->to(route('lego.blog.index'));
    }

    public function render()
    {
        return view('blog::models.blog.tags.form');
    }

    public function getModel(): Model
    {
        return $this->tag;
    }
}
