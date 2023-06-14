<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Block;

class FormSection extends Block
{
    protected $template;

    protected $title;

    protected $classes = [];

    private bool $showLine;

    public function __construct(?string $title = null, bool $showLine = true)
    {
        $this->title = $title;
        $this->showLine = $showLine;
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.formSection');
        $view->with('title', $this->title)
            ->with('classes', $this->classes)
            ->with('showLine', $this->showLine);

        return $view;
    }
}
