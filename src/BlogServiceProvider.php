<?php

namespace Astrogoat\Blog;

use Astrogoat\Blog\Http\Livewire\Models\ArticleForm;
use Astrogoat\Blog\Http\Livewire\Models\ArticleIndex;
use Astrogoat\Blog\Http\Livewire\Models\CategoryForm;
use Astrogoat\Blog\Http\Livewire\Models\CategoryIndex;
use Astrogoat\Blog\Http\Livewire\Models\TagForm;
use Astrogoat\Blog\Http\Livewire\Models\TagIndex;
use Astrogoat\Blog\Http\Livewire\Overlays\BrowseArticles;
use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Category;
use Astrogoat\Blog\Settings\BlogSettings;
use Helix\Fabrick\Icon;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Helix\Lego\Menus\Lego\Group;
use Helix\Lego\Menus\Lego\Link;
use Helix\Lego\Menus\Menu;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BlogServiceProvider extends PackageServiceProvider
{
    public function registerApp(App $app)
    {
        return $app
            ->name('blog')
            ->settings(BlogSettings::class)
            ->models([
                Article::class,
                Category::class,
            ])
            ->menu(function (Menu $menu) {
                $menu->addToSection(
                    Menu::MAIN_SECTIONS['PRIMARY'],
                    Group::add(
                        'Blog',
                        [
                            Link::to(route('lego.blog.articles.index'), 'Articles'),
                            Link::to(route('lego.blog.categories.index'), 'Categories'),
                            Link::to(route('lego.blog.tags.index'), 'Tags'),
                        ],
                        Icon::BOOK_OPEN,
                    )->after('Pages'),
                );
            })
            ->publishOnInstall([
                'blog-assets',
            ])
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->backendRoutes(__DIR__.'/../routes/backend.php')
            ->frontendRoutes(__DIR__.'/../routes/frontend.php');
    }

    public function registeringPackage()
    {
        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('blog')->hasViews();
    }

    public function bootingPackage()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/blog'),
            ], 'blog-assets');
        }

        Livewire::component('astrogoat.blog.articles-form', ArticleForm::class);
        Livewire::component('astrogoat.blog.categories-form', CategoryForm::class);
        Livewire::component('astrogoat.blog.tags-form', TagForm::class);
        Livewire::component('astrogoat.blog.browse-articles', BrowseArticles::class);
        Livewire::component('astrogoat.blog.http.livewire.models.article-index', ArticleIndex::class);
        Livewire::component('astrogoat.blog.http.livewire.models.category-index', CategoryIndex::class);
        Livewire::component('astrogoat.blog.http.livewire.models.tag-index', TagIndex::class);
    }
}
