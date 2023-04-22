<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class TextInput extends AbstractInput
{
    public function __construct(string $name, ?string $label = null, ?string $placeholder = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.text', $name, $label, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();

        return $view;
    }
}
