<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Concerns\AbstractBlock;
use Dev4b\LaravelCrudHelper\Concerns\HasHint;
use Dev4b\LaravelCrudHelper\Concerns\HasWidth;

abstract class AbstractInput extends AbstractBlock
{
    use HasHint, HasWidth;

    protected $template;

    protected string $name;

    protected ?string $id;

    protected ?string $label;

    protected ?string $placeholder;

    private string|array|null $value;

    public $showInputErrorMessages = true;

    protected $inputClasses = [];

    protected bool $required = false;

    protected $refreshList = [];

    protected bool $disabled = false;

    public function __construct(string $template, string $name, ?string $label = null, string|array|null $value = null, ?string $placeholder = null, ?string $id = null)
    {
        $this->template = $template;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->id = $id ?: $this->name;
    }

    public function addInputClass($class)
    {
        $this->inputClasses[] = $class;
    }

    public function isRequired()
    {
        $this->required = true;
    }

    public function render()
    {
        $view = view($this->template);
        $view->with('id', $this->id ?: $this->name)
            ->with('name', $this->name)
            ->with('label', $this->label)
            ->with('placeholder', $this->placeholder)
            ->with('hint', $this->hint)
            ->with('value', $this->value)
            ->with('containerClasses', $this->containerClasses)
            ->with('inputClasses', $this->inputClasses)
            ->with('required', $this->required)
            ->with('showInputErrorMessages', $this->showInputErrorMessages)
            ->with('refreshList', $this->refreshList)
            ->with('disabled', $this->disabled);

        return $view;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function setRefreshList(array $refreshList): void
    {
        $this->refreshList = $refreshList;
    }

    public function getRefreshList(): array
    {
        return $this->refreshList;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIdClean()
    {
        return str_replace(['[',']'], '', $this->id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
    }
}
