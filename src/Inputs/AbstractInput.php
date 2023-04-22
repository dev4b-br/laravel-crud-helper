<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

abstract class AbstractInput
{
    protected $template;

    protected string $name;

    protected ?string $id;

    protected ?string $label;

    protected ?string $placeholder;

    protected mixed $hint = null;

    public function __construct(string $template, string $name, ?string $label = null, ?string $placeholder = null, string $id = null)
    {
        $this->template = $template;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->id = $id;
    }

    public function setHint($hint)
    {
        $this->hint = $hint;
    }

    public function render()
    {
        $view = view($this->template);
        $view->with('id', $this->id)
            ->with('name', $this->name)
            ->with('label', $this->label)
            ->with('placeholder', $this->placeholder)
            ->with('hint', $this->hint);

        return $view;
    }
}
