<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class TextInput extends AbstractInput
{
    protected string $type = 'text';

    protected ?string $oldKey = null;

    protected array $maskBlocks = [];

    protected ?array $maskDelimiter = [];

    protected bool $isNumericalOnly = false;

    protected bool $isUpperCase = false;

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null)
    {
        $this->oldKey = $name;
        parent::__construct('laravel-crud-helper::inputs.text', $name, $label, $value, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('type', $this->type)
            ->with('oldKey', $this->oldKey)
            ->with('maskBlocks', $this->maskBlocks)
            ->with('maskDelimiter', $this->maskDelimiter)
            ->with('isNumericalOnly', $this->isNumericalOnly)
            ->with('isUpperCase', $this->isUpperCase);

        return $view;
    }

    /**
     * @param string|null $mask
     */
    public function setMask(array $blocks, ?array $delimiter = null): void
    {
        $this->maskBlocks = $blocks;
        $this->maskDelimiter = $delimiter;
    }

    public function setIsNumericalOnly(bool $isNumericalOnly)
    {
        $this->isNumericalOnly = $isNumericalOnly;
    }

    public function handleOld(bool $useOld, ?string $key)
    {
        $this->oldKey = $useOld ? $key : null;
    }
}
