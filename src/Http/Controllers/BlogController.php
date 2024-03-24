<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Category;
use Astrogoat\Blog\Models\Tag;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $articlesCount = Article::count();
        $tags = Tag::with('articles')->get();

        return view('blog::models.blog.index', compact('categoriesCount', 'articlesCount', 'tags'));
    }
}
