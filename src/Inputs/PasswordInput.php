<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class PasswordInput extends AbstractInput
{
    protected string $type = 'password';

    protected bool $visibilityEye = true;

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.password', $name, $label, $value, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('type', $this->type);
        return $view;
    }

    public function setVisibilityEye(bool $toggle)
    {
        $this->visibilityEye = $toggle;
    }
}
