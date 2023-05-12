<?php

namespace Dev4b\LaravelCrudHelper\Grids;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractResourceGrid
{
    protected Model $resource;

    private string $parentView;

    private Request $request;

    protected array $columns = [];

    public function __construct(Model $resource, $parentView, Request $request)
    {
        $this->resource = $resource;
        $this->parentView = $parentView;
        $this->request = $request;
        $this->setup();
        $this->addColumn(new GridColumn('actions', 'Ações', false, $this->getResourceName()));
    }

    abstract protected function setup();

    abstract protected function getQueryBuilder(): Builder;

    public function view(): View
    {
        $data = $this->getQueryBuilder()->get();
        return view('laravel-crud-helper::grid')
            ->with('parentView', $this->parentView)
            ->with('data', $data)
            ->with('columns', $this->columns);
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

    /**
     * @param array $columns
     */
    public function addColumn(GridColumn $column): void
    {
        $this->columns[] = $column;
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
