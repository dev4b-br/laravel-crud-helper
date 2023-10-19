<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class CheckboxInput extends AbstractInput
{
    protected string $type = 'checkbox';

    protected bool $checked = false;

    public function __construct(string $name, ?string $label = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.checkbox', $name, $label, null, null, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('type', $this->type)
            ->with('checked', $this->checked);

        return $view;
    }

    public function setChecked(bool $checked)
    {
        $this->checked = $checked;
    }
}
