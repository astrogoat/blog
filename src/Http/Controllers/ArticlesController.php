<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Article;
use Illuminate\Routing\Controller;

class ArticlesController extends Controller
{
    public function show(Article $article)
    {
        $article->load('sections');

        return view('lego::sectionables.show', ['sectionable' => $article]);
    }

    public function create()
    {
        return view('blog::models.blog.articles.create');
    }

    public function edit(Article $article)
    {
        return view('blog::models.blog.articles.edit', compact('article'));
    }

    public function editor(Article $article, $editorView = 'editor')
    {
        $article->load('sections');

        return view('lego::editor.editor', [
            'sectionable' => $article,
            'editorView' => $editorView,
        ]);
    }
}
