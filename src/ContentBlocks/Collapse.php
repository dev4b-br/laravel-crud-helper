<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class Collapse implements Content
{
    protected $classes = [];

    /**
     * @var Content
     */
    private Content $content ;

    private string $title;

    private string $id;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->id = uniqid('collapse-');
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.collapse');
        $view->with('id', $this->id)
            ->with('classes', $this->classes)
            ->with('title', $this->title)
            ->with('content', $this->content);

        return $view;
    }

    public function addContent(Content $content)
    {
        $this->content = $content;
    }
}
