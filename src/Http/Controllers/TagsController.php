<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Tag;
use Illuminate\Routing\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(20);

        return view('blog::models.blog.tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $tag->load('sections');

        return view('lego::sectionables.show', ['sectionable' => $tag]);
    }

    public function create()
    {
        return view('blog::models.blog.tags.create');
    }

    public function edit(Tag $tag)
    {
        return view('blog::models.blog.tags.edit', compact('tag'));
    }
}
