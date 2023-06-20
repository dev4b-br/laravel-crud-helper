<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class SwitchInput extends AbstractInput
{
    private $toggleUrl = null;

    public function __construct(string $name, ?string $label = null, ?bool $isChecked = false)
    {
        parent::__construct('laravel-crud-helper::inputs.switch', $name, $label, $isChecked);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('toggleUrl', $this->toggleUrl);

        return $view;
    }

    /**
     * @param null $toggleUrl
     */
    public function setToggleUrl($toggleUrl): void
    {
        $this->toggleUrl = $toggleUrl;
    }
}
