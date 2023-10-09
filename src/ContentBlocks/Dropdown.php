<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class Dropdown implements Content
{
    protected array $classes = [];

    private string $name = '';

    private string $icon = 'menu';

    /**
     * @var Link[]
     */
    private array $links = [];

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.dropdown');
        $view->with('classes', $this->classes)
            ->with('name', $this->name)
            ->with('icon', $this->icon)
            ->with('links', $this->links);

        return $view;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setIcon(string $icon)
    {
        $this->icon = $icon;
    }

    public function addLink(Link $link)
    {
        $link->addClass('dropdown-item');
        $this->links[] = $link;
    }

    public function getLinks(): array
    {
        return $this->links;
    }
}
