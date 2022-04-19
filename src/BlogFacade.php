<?php

namespace Astrogoat\Blog;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Blog\Blog
 */
class BlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'blog';
    }
}
