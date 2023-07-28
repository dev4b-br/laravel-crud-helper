<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Concerns\HasOld;

class RemoteSelectInput extends AbstractInput
{
    use HasOld;

    protected string $route;

    protected ?string $defaultOption;

    protected ?bool $isMultiple;

    public function __construct(string $name, string $route, ?string $label = null, ?string $defaultOption = null, ?bool $isMultiple = false, ?string $value = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.remoteSelect', $name, $label, $value, $id);
        $this->route = $route;
        $this->defaultOption = $defaultOption;
        $this->isMultiple = $isMultiple;
        $this->oldKey = $name;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('route', $this->route)
            ->with('defaultOption', $this->defaultOption)
            ->with('isMultiple', $this->isMultiple)
            ->with('oldKey', $this->oldKey);

        return $view;
    }
}
