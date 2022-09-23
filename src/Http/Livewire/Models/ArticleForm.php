<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Category;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Http\Livewire\Traits\CanBePublished;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Footer;
use Helix\Lego\Rules\SlugRule;

class ArticleForm extends Form
{
    use CanBePublished;

    public function rules()
    {
        return [
            'model.title' => 'required',
            'model.author' => 'required',
            'model.category_id' => 'required',
            'model.indexable' => 'nullable',
            'model.slug' => [new SlugRule($this->model)],
            'model.layout' => 'required',
            'model.footer_id' => 'nullable',
            'model.published_at' => 'nullable',
        ];
    }

    public function mount($article = null)
    {
        $this->setModel($article);

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
        return 'blog::models.blog.articles.form';
    }

    public function model(): string
    {
        return Article::class;
    }

    public function footers()
    {
        return Footer::all()->pluck('title', 'id');
    }

    public function categories()
    {
        return Category::all()->pluck('name', 'id');
    }

    public function category()
    {
        return $this->model->category;
    }

    public function getPublishableModel(): Publishable
    {
        return $this->model;
    }
}
