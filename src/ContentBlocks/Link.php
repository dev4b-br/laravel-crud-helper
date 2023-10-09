<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class Link implements Content
{
    protected array $classes = [];

    protected string $name = '';

    protected string $url = '';

    protected string $target;

    public function __construct(string $name, string $url, string $target = '_blank')
    {
        $this->name = $name;
        $this->url = $url;
        $this->target = $target;
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.link');
        $view->with('classes', $this->classes)
            ->with('name', $this->name)
            ->with('url', $this->url)
            ->with('target', $this->target);
        return $view;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function setTarget(string $target)
    {
        $this->target = $target;
    }


    public function addClass($class)
    {
        $this->classes[] = $class;
    }
}
