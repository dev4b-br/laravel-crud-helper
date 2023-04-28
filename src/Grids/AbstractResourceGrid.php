<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Dev4b\LaravelCrudHelper\Forms\Contracts\HasValidation;
use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractResourceGrid
{
    protected Model $resource;

    private string $parentView;

    public function __construct(Model $resource, $parentView)
    {
        $this->resource = $resource;
        $this->parentView = $parentView;
    }

    abstract protected function getQueryBuilder();

    public function view(): View
    {
        $data = $this->getQueryBuilder()->get();
        return view('laravel-crud-helper::grid')
            ->with('parentView', $this->parentView)
            ->with('data', $data);
    }

    public function render(): string
    {
        return $this->view()->render();
    }

    private function getResourceName()
    {
        $className = explode('\\', get_class($this->resource));
        return Str::lower(end($className));
    }

    protected function getRouteParams()
    {
        return [$this->resource];
    }

    public function getRedirectRoute()
    {
        return route($this->getResourceName() . '.index');
    }
}
