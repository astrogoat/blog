<?php

namespace Astrogoat\Blog\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Models\Contracts\Metafieldable;
use Helix\Lego\Models\Contracts\Sectionable;
use Helix\Lego\Models\Model as LegoModel;
use Helix\Lego\Models\Traits\HasMetafields;
use Helix\Lego\Models\Traits\HasSections;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends LegoModel implements Sectionable, Metafieldable
{
    use HasSections;
    use HasSlug;
    use HasMetafields;

    protected $table = 'blog_articles';

    public static function icon(): string
    {
        return Icon::EYE;
    }

    public function editorShowViewRoute(string $layout = null): string
    {
        return route('lego.blog.article.editor', [
            'article' => $this,
            'editor_view' => 'show',
            'layout' => $layout,
        ]);
    }

    public static function getDisplayKeyName(): string
    {
        return 'title';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($this->getDisplayKeyName())
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
