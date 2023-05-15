<?php

namespace Astrogoat\Blog\Bricks;

use Helix\Lego\Bricks\Brick;
use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class Category extends Brick
{
    public function hydrate($value): BrickValueObject
    {
        return new CategoryValueObject($value);
    }

    public function getDefaults()
    {
        return $this->default;
    }

    public function brickView(): string
    {
        return 'blog::bricks.category';
    }
}
