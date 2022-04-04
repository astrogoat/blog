<?php

namespace Astrogoat\Blog\Http\Livewire\Models;

use Astrogoat\Blog\Models\BlogArticle;
use Helix\Lego\Http\Livewire\Models\Form;
use Helix\Lego\Models\Footer;
use Helix\Lego\Models\Model;
use Helix\Lego\Rules\SlugRule;
use Illuminate\Support\Str;

class ArticleForm extends Form
{
    public BlogArticle $article;

    public function rules()
    {
        return [
            'article.title' => 'required',
            'article.author' => 'required',
            'article.image' => 'nullable',
            'article.category' => 'nullable',
            'location.slug' => [new SlugRule($this->article)],
            'location.layout' => 'nullable',
            'location.footer_id' => 'nullable',
        ];
    }

    public function saved()
    {
        if ($this->article->wasRecentlyCreated) {
            return redirect()->to(route('lego.blog.article.edit', $this->article));
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
        return redirect()->to(route('lego.blog.article.index'));
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
}