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

class BlogArticle extends LegoModel implements Sectionable, Metafieldable
{
    use HasSections;
    use HasSlug;
    use HasMetafields;

    protected $table = 'blog_articles';

    public static function icon(): string
    {
        return Icon::EYE;
    }

    public static function getStoreKeyName(): string
    {
        return 'name';
    }

    public static function getAddressKeyName(): string
    {
        return 'address';
    }

    public function editorShowViewRoute(string $layout = null): string
    {
        return route('lego.locations.editor', [
            'location' => $this,
            'editor_view' => 'show',
            'layout' => $layout,
        ]);
    }

    public static function getDisplayKeyName(): string
    {
        return 'name';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($this->getDisplayKeyName())
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}