<?php

namespace Astrogoat\Blog\Http\Controllers;

use Astrogoat\Blog\Models\Group;
use Illuminate\Routing\Controller;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(20);

        return view('blog::models.blog.groups.index', compact('groups'));
    }

    public function show(Group $group)
    {
        $group->load('sections');

        return view('lego::sectionables.show', ['sectionable' => $group]);
    }

    public function create()
    {
        return view('blog::models.blog.groups.create');
    }

    public function edit(Group $group)
    {
        return view('blog::models.blog.groups.edit', compact('group'));
    }
}
