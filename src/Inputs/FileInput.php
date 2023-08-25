<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class FileInput extends AbstractInput
{
    public function __construct(string $name, ?string $label = null, ?string $placeholder = null, string $id = null, ?bool $isMultiple = false)
    {
        parent::__construct('laravel-crud-helper::inputs.file', $name, $label, $placeholder, $id);
        $this->isMultiple = $isMultiple;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('isMultiple', $this->isMultiple);

        return $view;
    }
}
