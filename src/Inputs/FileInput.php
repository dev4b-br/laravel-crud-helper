<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class FileInput extends AbstractInput
{
    public function __construct(string $name, ?string $label = null, ?string $placeholder = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.file', $name, $label, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();

        return $view;
    }
}
