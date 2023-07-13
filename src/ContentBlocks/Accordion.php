<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class Accordion implements Content
{
    protected $classes = [];

    /**
     * @var Content[]
     */
    private array $items = [];

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.accordion');
        $view->with('classes', $this->classes)
            ->with('items', $this->items);

        return $view;
    }

    public function addItem(Content $item)
    {
        $this->items[] = $item;
    }
}
