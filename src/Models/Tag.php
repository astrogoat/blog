<?php

namespace Astrogoat\Blog\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Model as LegoModel;

class Tag extends LegoModel
{
    protected $table = 'article_tags';

    public static function icon(): string
    {
        return Icon::DOCUMENT_TEXT;
    }

    public static function getDisplayKeyName(): string
    {
        return 'title';
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags_and_article');
    }
}
