<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Category;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $articlesCount = Article::count();

        return view('blog::models.blog.index', compact('categoriesCount', 'articlesCount'));
    }
}
