<?php

namespace Astrogoat\Blog\Bricks;

use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class ArticleValueObject extends BrickValueObject
{
    protected $cache = [];

    public function __construct(protected $value)
    {
    }

    public function getArticleModel()
    {
        if (isset($this->cache[$this->value])) {
            return $this->cache[$this->value];
        }

        $this->cache[$this->value] = \Astrogoat\Blog\Models\Article::find($this->value);

        return $this->cache[$this->value];
    }

    public function getValue()
    {
        return $this->value;
        $selectedArticle = \Astrogoat\Blog\Models\Article::find($this->value);

        return $selectedArticle != null ? $selectedArticle->title : '';
    }

    public function forJavascript()
    {
        return $this->getValue() ?? '';
    }

    public function __toString()
    {
        return '';
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
