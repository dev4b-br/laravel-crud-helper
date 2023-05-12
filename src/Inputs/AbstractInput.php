<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

abstract class AbstractInput
{
    protected $template;

    protected string $name;

    protected ?string $id;

    protected ?string $label;

    protected ?string $placeholder;

    protected mixed $hint = null;

    private ?string $value;

    public $showInputErrorMessages = true;

    protected $inputClasses = [];

    protected $containerClasses = [];

    public function __construct(string $template, string $name,  ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null)
    {
        $this->template = $template;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->id = $id;
    }

    public function setHint($hint)
    {
        $this->hint = $hint;
    }

    public function setHalf()
    {
        $this->addContainerClass('col-6');
    }

    public function addContainerClass($class)
    {
        $this->containerClasses[] = $class;
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
