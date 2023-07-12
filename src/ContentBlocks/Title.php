<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class Title implements Content
{
    protected $title;

    protected $classes = [];

    public function __construct(?string $title = null, ?array $classes = [])
    {
        $this->title = $title;
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.title');
        $view->with('title', $this->title)
            ->with('classes', $this->classes);

        return $view;
    }
}
