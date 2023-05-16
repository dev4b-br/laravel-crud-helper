<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class SwitchInput extends AbstractInput
{
    public function __construct(string $name, ?string $label = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.switch', $name, $label, $id);
    }

    public function render()
    {
        $view = parent::render();

        return $view;
    }
}
