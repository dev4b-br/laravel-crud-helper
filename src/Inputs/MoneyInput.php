<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class MoneyInput extends AbstractInput
{
    protected ?string $currency = 'R$';

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.money', $name, $label, $value, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('currency', $this->currency);

        return $view;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
}
