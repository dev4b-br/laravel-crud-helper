<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

use Illuminate\Database\Eloquent\Builder;

class ResourceSelectInput extends SelectInput
{
    private Builder $query;
    private string $descriptionColumn;
    protected ?bool $isMultiple;

    public function __construct(string $name, Builder $query, string $descriptionColumn, ?string $label = null, ?bool $isMultiple = false, ?string $value = null, string $id = null)
    {
        $this->query = $query;
        $this->descriptionColumn = $descriptionColumn;
        parent::__construct($name, $label, $this->getOptions(), $isMultiple, $value, $id);
    }

    public function render()
    {
        $view = parent::render();

        return $view->with('isMultiple', $this->isMultiple);
    }

    private function getOptions()
    {
        return $this->query->get()->pluck($this->descriptionColumn, 'id')->toArray();
    }
}
