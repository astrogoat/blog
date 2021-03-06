<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Category;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Models\Footer;
use Helix\Lego\Models\Model;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Str;

class CategoryForm extends Form
{
    public Category $category;

    public function rules()
    {
        return [
            'category.name' => 'required',
            'category.description' => 'nullable',
            'category.indexable' => 'nullable',
            'category.slug' => [new SlugRule($this->category)],
            'category.layout' => 'required',
            'category.footer_id' => 'nullable',
        ];
    }

    public function mounted()
    {
        if (! $this->category->exists) {
            $this->category->indexable = true;
            $this->category->layout = array_key_first(siteLayouts());
        }
    }

    public function saved()
    {
        if ($this->category->wasRecentlyCreated) {
            return redirect()->to(route('lego.blog.categories.edit', $this->category));
        }
    }

    public function updating($property, $value)
    {
        parent::updating($property, $value);

        if ($property == 'category.name' && ! $this->category->exists) {
            $this->category->slug = Str::slug($value);
        }
    }

    public function updated($property, $value)
    {
        parent::updated($property, $value);

        if ($property == 'category.footer_id' && ! $value) {
            $this->category->footer_id = null;
        }
    }

    public function deleted()
    {
        return redirect()->to(route('lego.blog.categories.index'));
    }

    public function render()
    {
        return view('blog::models.blog.categories.form');
    }

    public function getModel(): Model
    {
        return $this->category;
    }

    public function articles()
    {
        return $this->category->articles()->paginate(8);
    }

    public function footers()
    {
        return Footer::all()->pluck('title', 'id');
    }
}
