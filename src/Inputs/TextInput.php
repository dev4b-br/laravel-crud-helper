<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class TextInput extends AbstractInput
{
    protected string $type = 'text';

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.text', $name, $label, $value, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('type', $this->type);

        return $view;
    }
}
