<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Dev4b\LaravelCrudHelper\Contracts\Fileable;

class FileInput extends AbstractInput
{
    protected Fileable $fileable;

    protected string $deleteFileRoute;


    public function __construct(string $name, ?string $label = null, ?string $placeholder = null, string $id = null, ?bool $isMultiple = false)
    {
        parent::__construct('laravel-crud-helper::inputs.file', $name, $label, $placeholder, $id);
        $this->isMultiple = $isMultiple;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('isMultiple', $this->isMultiple)
            ->with('files', $this->fileable->files()->get())
            ->with('deleteFileRoute', $this->deleteFileRoute);

        return $view;
    }

    public function setFileable(Fileable $fileable): void
    {
        $this->fileable = $fileable;
    }

    public function setDeleteFileRoute(string $deleteFileRoute): void
    {
        $this->deleteFileRoute = $deleteFileRoute;
    }
}
