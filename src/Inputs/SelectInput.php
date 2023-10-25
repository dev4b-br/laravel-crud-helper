<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Concerns\HasOld;

class SelectInput extends AbstractInput
{
    use HasOld;

    private ?array $options;

    protected ?bool $isMultiple;

    protected bool $searchBar = true;

    protected bool $showDefaultOption = false;

    protected bool $disabledDefaultOption = true;

    protected bool $isSelect2 = true;

    public function __construct(string $name, ?string $label = null, ?array $options = [], ?bool $isMultiple = false, string|array|null $value = null, string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.select', $name, $label, $value, null, $id);
        $this->options = $options;
        $this->isMultiple = $isMultiple;
        $this->oldKey = $name;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('options', $this->options)
            ->with('isMultiple', $this->isMultiple)
            ->with('searchBar', $this->searchBar)
            ->with('oldKey', $this->oldKey)
            ->with('showDefaultOption', $this->showDefaultOption)
            ->with('disabledDefaultOption', $this->disabledDefaultOption)
            ->with('cleanId', $this->getIdClean())
            ->with('isSelect2', $this->isSelect2);

        return $view;
    }

    public function disableSearchBar()
    {
        $this->searchBar = false;
    }

    public function setOptions(?array $options): void
    {
        $this->options = $options;
    }

    public function showDefaultOption(bool $showDefaultOption, bool $disabledDefaultOption = true): void
    {
        $this->showDefaultOption = $showDefaultOption;
        $this->disabledDefaultOption = $disabledDefaultOption;
    }

    public function setIsSelect2(bool $isSelect2): void
    {
        $this->isSelect2 = $isSelect2;
    }
}
