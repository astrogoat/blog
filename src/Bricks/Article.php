<?php

namespace Astrogoat\Blog\Bricks;

use Helix\Lego\Bricks\Brick;

class Article extends Brick
{
    public function getDefaults()
    {
        return $this->default;
    }

    public function brickView(): string
    {
        return 'blog::bricks.article';
    }
}
