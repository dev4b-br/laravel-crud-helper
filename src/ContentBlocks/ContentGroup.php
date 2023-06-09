<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class ContentGroup implements Content
{
    /**
     * @var Content[]
     */
    private array $items = [];

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.contentGroup');
        $view->with('items', $this->items);

        return $view;
    }

    public function addItem(Content $item)
    {
        $this->items[] = $item;
    }
}
