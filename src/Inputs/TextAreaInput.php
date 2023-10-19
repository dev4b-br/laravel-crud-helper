<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Concerns\HasOld;

class TextAreaInput extends AbstractInput
{
    use HasOld;

    protected bool $isRichText = false;

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, string $id = null)
    {
        $this->oldKey = $name;
        parent::__construct('laravel-crud-helper::inputs.textarea', $name, $label, $value, $placeholder, $id);
    }

    public function render()
    {
        $view = parent::render();
        $view->with('oldKey', $this->oldKey)
            ->with('isRichText', $this->isRichText);

        return $view;
    }

    public function setIsRichText(bool $isRichText): void
    {
        $this->isRichText = $isRichText;
    }
}
