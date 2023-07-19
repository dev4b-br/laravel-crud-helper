<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Concerns\HasOld;

class MoneyInput extends AbstractInput
{
    use HasOld;

    protected ?string $currency = 'R$';

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null)
    {
        $this->oldKey = $name;
        parent::__construct('laravel-crud-helper::inputs.money', $name, $label, $value, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('currency', $this->currency)
            ->with('oldKey', $this->oldKey);

        return $view;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
}
