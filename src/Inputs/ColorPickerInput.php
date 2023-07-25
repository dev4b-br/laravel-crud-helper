<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class ColorPickerInput extends AbstractInput
{
    protected string $defaultColor = "#0d6efd";

    public function __construct(string $name, ?string $label = null, ?string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.colorPicker', $name, $label, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('defaultColor', $this->defaultColor);

        return $view;
    }

    public function setDefaultColor(string $color): void
    {
        $this->defaultColor = $color;
    }
}
