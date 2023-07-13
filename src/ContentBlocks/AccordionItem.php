<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class AccordionItem implements Content
{
    protected $title;

    /**
     * @var Content[]
     */
    protected $content = [];

    private string $id;

    public function __construct(string $title)
    {
        $this->id = uniqid('accordion-item');
        $this->title = $title;
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.accordionItem');
        $view->with('id', $this->id)
            ->with('title', $this->title)
            ->with('content', $this->content);

        return $view;
    }

    public function addContent(Content $content)
    {
        $this->content[] = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getId()
    {
        return $this->id;
    }
}
