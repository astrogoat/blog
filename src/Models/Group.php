<?php

namespace Astrogoat\Blog\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Model as LegoModel;
use Helix\Lego\Models\Contracts\Sectionable;
use Helix\Lego\Models\Traits\HasSections;

class Group extends LegoModel implements Sectionable
{
    use HasSections;

    protected $table = 'article_groups';

    public static function icon(): string
    {
        return Icon::DOCUMENT_TEXT;
    }

    public function editorShowViewRoute(string $layout = null): string
    {
//        return route('lego.blog.group.editor', [
//            'group' => $this,
//            'editor_view' => 'show',
//            'layout' => $layout,
//        ]);
    }

    public static function getDisplayKeyName(): string
    {
        return 'title';
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_groups_and_article');
    }

}
