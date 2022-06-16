<?php

namespace Astrogoat\Blog\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Media\HasMedia;
use Helix\Lego\Media\Mediable;
use Helix\Lego\Media\MediaCollection;
use Helix\Lego\Models\Contracts\Indexable;
use Helix\Lego\Models\Contracts\Metafieldable;
use Helix\Lego\Models\Contracts\Searchable;
use Helix\Lego\Models\Contracts\Sectionable;
use Helix\Lego\Models\Model as LegoModel;
use Helix\Lego\Models\Traits\HasMetafields;
use Helix\Lego\Models\Traits\HasSections;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends LegoModel implements Sectionable, Indexable, Searchable, Metafieldable, Mediable
{
    use HasSections;
    use HasSlug;
    use HasMetafields;
    use HasMedia;

    protected $table = 'blog_categories';

    public static function icon(): string
    {
        return Icon::COLLECTION;
    }

    public function editorShowViewRoute(string $layout = null): string
    {
        return route('lego.blog.categories.editor', [
            'category' => $this,
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

    public function shouldIndex(): bool
    {
        return $this->indexable;
    }

    public function getIndexedRoute(): string
    {
        return $this->getPublishedRoute();
    }

    public function getPublishedRoute(): string
    {
        return route('blog.categories.show', $this);
    }

    public static function searchableIcon(): string
    {
        return static::icon();
    }

    public static function searchableIndexRoute(): string
    {
        return route('lego.blog.categories.index');
    }

    public function scopeGlobalSearch($query, $value)
    {
        return $query->where('name', 'LIKE', "%{$value}%");
    }

    public function searchableName(): string
    {
        return $this->name;
    }

    public function searchableDescription(): string
    {
        return strip_tags($this->description) ?? '';
    }

    public function searchableRoute(): string
    {
        return route('lego.blog.categories.edit', $this);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function getMedia(): array
    {
        return $this->featured_image ?: [];
    }

    public function mediaCollections(): array
    {
        return [
            MediaCollection::name('Featured')->maxFiles(1),
        ];
    }
}
