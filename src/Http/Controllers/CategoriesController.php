<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Category;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $category->load('sections');

        return view('lego::sectionables.show', ['sectionable' => $category]);
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
