<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

class DynamicRowsGroup extends ContentGroup
{
    protected $callbackFunction;

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.dynamicRowsGroup');
        $view->with('items', $this->items)
            ->with('callbackFunction', $this->callbackFunction);

        return $view;
    }

    /**
     * @param mixed $callbackFunction
     */
    public function setCallbackFunction($callbackFunction): void
    {
        $this->callbackFunction = $callbackFunction;
    }
}
