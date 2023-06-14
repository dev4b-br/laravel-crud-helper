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

    private ?string $value;

    public $showInputErrorMessages = true;

    protected $inputClasses = [];

    public function __construct(string $template, string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null)
    {
        $this->template = $template;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->id = $id;
    }

    public function addInputClass($class)
    {
        $this->inputClasses[] = $class;
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
            ->with('showInputErrorMessages', $this->showInputErrorMessages);

        return $view;
    }
}
