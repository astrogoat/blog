<?php

namespace Astrogoat\Blog\Bricks;

use Helix\Lego\Bricks\ValueObjects\BrickValueObject;

class ArticleValueObject extends BrickValueObject
{
    protected array $cache = [];

    public function getArticleModel()
    {
        if (isset($this->cache[$this->getValue()])) {
            return $this->cache[$this->getValue()];
        }

        $this->cache[$this->getValue()] = \Astrogoat\Blog\Models\Article::find($this->getValue());

        return $this->cache[$this->getValue()];
    }

    public function getValue()
    {
        $selectedArticle = \Astrogoat\Blog\Models\Article::find(parent::getValue());

        return $selectedArticle != null ? $selectedArticle->title : '';
    }

    public function forJavascript()
    {
        return $this->value ?? '';
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
