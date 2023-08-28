<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\AbstractBlock;
use Dev4b\LaravelCrudHelper\Concerns\Content;
use Illuminate\Contracts\Support\Renderable;

class DynamicRowsGroup Extends ContentGroup
{
    public function render()
    {
        $this->addClassToItems();

        $view = view('laravel-crud-helper::content-blocks.dynamicRowsGroup');
        $view->with('items', $this->items);

        return $view;
    }

    private function addClassToItems()
    {

    }
}
