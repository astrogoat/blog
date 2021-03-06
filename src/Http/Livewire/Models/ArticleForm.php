<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Category;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Http\Livewire\Traits\CanBePublished;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Footer;
use Helix\Lego\Models\Model;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Str;

class ArticleForm extends Form
{
    use CanBePublished;

    public Article $article;

    public function rules()
    {
        return [
            'article.title' => 'required',
            'article.author' => 'required',
            'article.category_id' => 'nullable',
            'article.indexable' => 'nullable',
            'article.slug' => [new SlugRule($this->article)],
            'article.layout' => 'required',
            'article.footer_id' => 'nullable',
            'article.published_at' => 'nullable',
        ];
    }

    public function mounted()
    {
        if (! $this->article->exists) {
            $this->article->indexable = true;
            $this->article->layout = array_key_first(siteLayouts());
        }
    }

    public function saved()
    {
        if ($this->article->wasRecentlyCreated) {
            return redirect()->to(route('lego.blog.articles.edit', $this->article));
        }
    }

    public function updating($property, $value)
    {
        parent::updating($property, $value);

        if ($property == 'article.title' && ! $this->article->exists) {
            $this->article->slug = Str::slug($value);
        }
    }

    public function updated($property, $value)
    {
        parent::updated($property, $value);

        if ($property == 'article.footer_id' && ! $value) {
            $this->article->footer_id = null;
        }
    }

    public function deleted()
    {
        return redirect()->to(route('lego.blog.articles.index'));
    }

    public function render()
    {
        return view('blog::models.blog.articles.form');
    }

    public function getModel(): Model
    {
        return $this->article;
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
        return $this->article->category;
    }

    public function getPublishableModel(): Publishable
    {
        return $this->article;
    }
}
