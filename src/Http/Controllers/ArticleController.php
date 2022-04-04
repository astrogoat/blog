<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\BlogArticle;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = BlogArticle::paginate(20);

        return view('blog::models.blog.articles.index', compact('articles'));
    }

    public function show(BlogArticle $article)
    {
        $article->load('sections');

        return view('lego::sectionables.show', ['sectionable' => $article]);
    }

    public function create()
    {
        return view('blog::models.blog.articles.create');
    }

    public function edit(BlogArticle $article)
    {
        return view('blog::models.blog.articles.edit', compact('article'));
    }

    public function editor(BlogArticle $article, $editorView = 'editor')
    {
        $article->load('sections');

        return view('lego::editor.editor', [
            'sectionable' => $article,
            'editorView' => $editorView,
        ]);
    }
}
