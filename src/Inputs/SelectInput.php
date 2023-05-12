<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class SelectInput extends AbstractInput
{
    private ?array $options;

    public function __construct(string $name, ?string $label = null, ?array $options = [], ?string $value = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.select', $name, $label, $value, null, $id);
        $this->options = $options;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('options', $this->options);

        return $view;
    }
}
