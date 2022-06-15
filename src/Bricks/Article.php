<?php

namespace Astrogoat\Blog\Bricks;

use Helix\Lego\Bricks\Brick;
use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class Article extends Brick
{
    public function hydrate($value): BrickValueObject
    {
        return new ArticleValueObject($value);
    }

    public function getDefaults()
    {
        return $this->default;
    }

    public function brickView(): string
    {
        return 'blog::bricks.article';
    }
}
