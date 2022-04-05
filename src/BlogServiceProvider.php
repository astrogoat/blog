<?php

namespace Astrogoat\Blog;

use Astrogoat\Blog\Http\Livewire\Models\ArticleForm;
use Astrogoat\Blog\Http\Livewire\Models\CategoryForm;
use Astrogoat\Blog\Models\Article;
use Astrogoat\Blog\Models\Category;
use Helix\Fabrick\Icon;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Helix\Lego\Menus\Lego\Link;
use Helix\Lego\Menus\Menu;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Astrogoat\Blog\Settings\BlogSettings;
use Livewire\Livewire;

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
                    Link::to(route('lego.blog.category.index'), 'Blog')
                        ->after('Pages')
                        ->icon(Icon::LOCATION_MARKER)
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

    }
}
