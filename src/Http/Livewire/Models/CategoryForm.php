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
        $this->selectedArticles = $this->model->articles;

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

    public function articles()
    {
        return $this->model->articles()->paginate(8);
    }

    public function footers()
    {
        return Footer::all()->pluck('title', 'id');
    }

    public function getPublishableModel(): Publishable
    {
        return $this->model;
    }
}
