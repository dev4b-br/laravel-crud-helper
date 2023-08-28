<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;
use Illuminate\Contracts\Support\Renderable;

class ContentGroup implements Content
{
    /**
     * @var Content[]
     */
    protected array $items = [];

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.contentGroup');
        $view->with('items', $this->items);

        return $view;
    }

    public function addItem(Renderable $item)
    {
        $this->items[] = $item;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
