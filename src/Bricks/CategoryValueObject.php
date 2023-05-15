<?php

namespace Astrogoat\Blog\Bricks;

use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class CategoryValueObject extends BrickValueObject
{
    protected $cache = [];

    public function __construct(protected $value)
    {
    }

    public function getCategoryModel()
    {
        if (isset($this->cache[$this->value])) {
            return $this->cache[$this->value];
        }

        $this->cache[$this->value] = \Astrogoat\Blog\Models\Category::find($this->value);

        return $this->cache[$this->value];
    }

    public function getValue()
    {
        $selectedCategory = \Astrogoat\Blog\Models\Category::find($this->value);

        return $selectedCategory != null ? $selectedCategory->name : '';
    }

    public function forJavascript()
    {
        return $this->getValue() ?? '';
    }

    public function __toString()
    {
        return $this->getValue() ?? '';
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}
