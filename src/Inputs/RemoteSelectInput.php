<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Concerns\HasOld;

class RemoteSelectInput extends AbstractInput
{
    use HasOld;

    protected string $route;

    protected ?string $defaultOption;

    protected ?bool $isMultiple;

    private $options = [];

    private ?array $value;

    private $maximumSelectionLength;

    private $minimumInputLength;

    private $allowCreateItem = false;

    public function __construct(string $name, string $route, ?string $label = null, ?string $defaultOption = null, ?bool $isMultiple = false, ?array $value = [], string $id = null)
    {
        parent::__construct('laravel-crud-helper::inputs.remoteSelect', $name, $label, null, $id);
        $this->route = $route;
        $this->defaultOption = $defaultOption;
        $this->isMultiple = $isMultiple;
        $this->oldKey = $name;
        $this->value = $value;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('route', $this->route)
            ->with('defaultOption', $this->defaultOption)
            ->with('isMultiple', $this->isMultiple)
            ->with('oldKey', $this->oldKey)
            ->with('options', $this->options)
            ->with('value', $this->value)
            ->with('maximumSelectionLength', $this->maximumSelectionLength)
            ->with('minimumInputLength', $this->minimumInputLength)
            ->with('allowCreateItem', $this->allowCreateItem);

        return $view;
    }

    public function addOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param mixed $maximumSelectionLength
     */
    public function setMaximumSelectionLength(int $maximumSelectionLength): void
    {
        $this->maximumSelectionLength = $maximumSelectionLength;
    }

    /**
     * @param mixed $minimumInputLength
     */
    public function setMinimumInputLength(int $minimumInputLength): void
    {
        $this->minimumInputLength = $minimumInputLength;
    }

    public function setAllowCreateItem(bool $allowCreateItem): void
    {
        $this->allowCreateItem = $allowCreateItem;
    }
}
