<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class ColorPickerInput extends AbstractInput
{
    protected string $defaultValue = "#0d6efd";

    public function __construct(string $name, ?string $label = null, ?string $id = null, ?string $value = null)
    {
        parent::__construct('laravel-crud-helper::inputs.colorPicker', $name, $label, $id, $value);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('defaultValue', $this->defaultValue);

        return $view;
    }
}
