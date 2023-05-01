<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Category;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Http\Livewire\Traits\CanBePublished;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Footer;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Collection;

class CategoryForm extends Form
{
    use CanBePublished;

    public Collection $selectedArticles;
    public Collection $initialArticlesOrder;

    protected $listeners = [
        'updateArticlesOrder',
    ];
    
    public function rules()
    {
        return [
            'model.name' => 'required',
            'model.description' => 'nullable',
            'model.indexable' => 'nullable',
            'model.slug' => [new SlugRule($this->model)],
            'model.layout' => 'required',
            'model.footer_id' => 'nullable',
            'model.published_at' => 'nullable',
        ];
    }

    public function mount($category = null)
    {
        $this->setModel($category);
        $this->selectedArticles = $this->model->articles()->orderBy('order','asc')->get();
        $this->initialArticlesOrder = $this->selectedArticles->mapWithKeys(fn ($article, $index) => [$article->id => $article->order]);
        //dd($this->model->articles()->leftJoin('blog_category_blog_article','blog_category_blog_article.article_id','blog_articles.id'));
        ray($this->selectedArticles,$this->initialArticlesOrder);
        if (! $this->model->exists) {
            $this->model->indexable = true;
            $this->model->layout = array_key_first(siteLayouts());
        }
    }

    public function updated($property, $value)
    {
        parent::updated($property, $value);

        if ($property == 'model.footer_id' && ! $value) {
            $this->model->footer_id = null;
        }
    }

    public function view()
    {
        return 'blog::models.blog.categories.form';
    }

    public function model(): string
    {
        return Category::class;
    }


    public function footers()
    {
        return Footer::all()->pluck('title', 'id');
    }

    public function getPublishableModel(): Publishable
    {
        return $this->model;
    }


    public function saving()
    {
        $selectedArticlesOrderCollection=$this->selectedArticles->mapWithKeys(fn ($article, $index) => [$article->id => $index]);
        $articlesThatChangedPosition = $selectedArticlesOrderCollection->diffAssoc($this->initialArticlesOrder);

        foreach($articlesThatChangedPosition as $articleThatChangedPosition){
            $this->selectedArticles[$articleThatChangedPosition]->order=$articleThatChangedPosition;
            $this->selectedArticles[$articleThatChangedPosition]->save();
        }
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

}
