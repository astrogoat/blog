<?php

namespace Astrogoat\Blog\Models;

use Helix\Fabrick\Icon;
use Helix\Lego\Media\HasMedia;
use Helix\Lego\Media\Mediable;
use Helix\Lego\Media\MediaCollection;
use Helix\Lego\Models\Contracts\Indexable;
use Helix\Lego\Models\Contracts\Metafieldable;
use Helix\Lego\Models\Contracts\Publishable;
use Helix\Lego\Models\Contracts\Searchable;
use Helix\Lego\Models\Contracts\Sectionable;
use Helix\Lego\Models\Model as LegoModel;
use Helix\Lego\Models\Traits\CanBePublished;
use Helix\Lego\Models\Traits\HasFooter;
use Helix\Lego\Models\Traits\HasMetafields;
use Helix\Lego\Models\Traits\HasSections;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends LegoModel implements Sectionable, Indexable, Publishable, Searchable, Metafieldable, Mediable
{
    use CanBePublished;
    use HasSections;
    use HasSlug;
    use HasMetafields;
    use HasMedia;
    use HasFooter;

    protected $table = 'blog_articles';

    protected $dates = [
        'published_at',
    ];

    public static function icon(): string
    {
        return Icon::DOCUMENT_TEXT;
    }

    public function editorShowViewRoute(string $layout = null): string
    {
        return route('lego.blog.articles.editor', [
            'article' => $this,
            'editor_view' => 'show',
            'layout' => $layout,
        ]);
    }

    public static function getDisplayKeyName(): string
    {
        return 'title';
    }

    public static function getAuthorKey(): string
    {
        return 'author';
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

    public static function searchableIcon(): string
    {
        return static::icon();
    }

    public static function searchableIndexRoute(): string
    {
        return route('lego.blog.articles.index');
    }

    public static function getGlobalSearchableFields(): array
    {
        return ['title', 'slug'];
    }

    public function scopeGlobalSearch($query, $value)
    {
        return $query->where('title', 'LIKE', "%{$value}%");
    }

    public function searchableName(): string
    {
        return $this->title;
    }

    public function searchableDescription(): string
    {
        return $this->author ?? '';
    }

    public function searchableRoute(): string
    {
        return route('lego.blog.articles.edit', $this);
    }

    public function getPublishedAtKey(): string
    {
        return 'published_at';
    }

    public function getCreateRoute(array $parameters = []): string
    {
        return route('lego.blog.articles.create', $parameters);
    }

    public function getEditRoute(): string
    {
        return route('lego.blog.articles.edit', $this);
    }

    public function getPublishedRoute(): string
    {
        return route('blog.articles.show', $this);
    }

    public function getEditorRoute(): string
    {
        return route('lego.blog.articles.editor', $this);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags_and_article');
    }

    public function mediaCollections(): array
    {
        return [
            MediaCollection::name('Featured')->maxFiles(1),
        ];
    }

    public function canonicalUrl(array $parameters = []): string
    {
        return route('blog.articles.show', $this);
    }
}
