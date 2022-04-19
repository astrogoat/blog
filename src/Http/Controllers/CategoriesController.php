<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Category;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(20);

        return view('blog::models.blog.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('sections');

        return view('lego::sectionables.show', ['sectionable' => $category]);
    }

    public function create()
    {
        return view('blog::models.blog.categories.create');
    }

    public function edit(Category $category)
    {
        return view('blog::models.blog.categories.edit', compact('category'));
    }

    public function editor(Category $category, $editorView = 'editor')
    {
        $category->load('sections');

        return view('lego::editor.editor', [
            'sectionable' => $category,
            'editorView' => $editorView,
        ]);
    }
}
