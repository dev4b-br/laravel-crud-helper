<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class CheckboxInput extends AbstractInput
{
    protected string $type = 'checkbox';

    public function __construct(string $name, ?string $label = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.checkbox', $name, $label, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('type', $this->type);

        return $view;
    }
}
