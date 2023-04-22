<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractResourceForm
{
    private Model $resource;

    private array $inputs = [];

    public function __construct(Model $resource)
    {
        $this->resource = $resource;
        $this->setup();
    }

    abstract protected function setup();

    public function view(): View
    {
        return view('laravel-crud-helper::form')
            ->with('inputs', $this->inputs)
            ->with('action', $this->getAction());
    }

    public function execute(Request $request)
    {

    }

    public function render(): string
    {
        return $this->view()->render();
    }

    public function addInput(AbstractInput $input)
    {
        $this->inputs[] = $input;
    }

    private function getAction(): string
    {
        $className = explode('\\', get_class($this->resource));
        return Str::lower(end($className)) . '.create';
    }
}
