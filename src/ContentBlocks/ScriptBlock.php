<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class ScriptBlock implements Content
{
    private string $script;

    public function __construct(string $script)
    {
        $this->script = $script;
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.scriptBlock');
        $view->with('script', $this->script);

        return $view;
    }
}
