<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class SelectInput extends AbstractInput
{
    private ?array $options;

    protected ?bool $isMultiple;

    public function __construct(string $name, ?string $label = null, ?array $options = [], ?bool $isMultiple = false, ?string $value = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.select', $name, $label, $value, $id);
        $this->options = $options;
        $this->isMultiple = $isMultiple;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('options', $this->options)
            ->with('isMultiple', $this->isMultiple);

        return $view;
    }
}
