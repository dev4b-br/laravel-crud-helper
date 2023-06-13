<?php

namespace Dev4b\LaravelCrudHelper\Grids;

use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractResourceGrid
{
    const DEFAULT_LIMIT = 10;

    protected Model $resource;

    private string $parentView;

    protected Request $request;

    protected array $columns = [];

    private array $filters = [];

    public function __construct(Model $resource, $parentView, Request $request, $actionsColumn = true)
    {
        $this->resource = $resource;
        $this->parentView = $parentView;
        $this->request = $request;
        $this->setup();
        if ($actionsColumn) {
            $this->addColumn(new GridColumn('actions', 'Ações', false, $this->getResourceName()));
        }
    }

    protected function applyFilters(Builder $queryBuilder, Request $request): void
    {

    }

    abstract protected function setup();

    abstract protected function getQueryBuilder(): Builder;

    public function view(): View
    {
        $queryBuilder = $this->getQueryBuilder();
        $this->applyFilters($queryBuilder, $this->request);

        $data = $queryBuilder->paginate($this->getLimit());
        return view('laravel-crud-helper::grid')
            ->with('filters', $this->filters)
            ->with('parentView', $this->parentView)
            ->with('data', $data)
            ->with('columns', $this->columns)
            ->with('limit', $this->getLimit());
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

    public function addFilter(AbstractInput $input)
    {
        $this->filters[] = $input;
    }

    private function getLimit()
    {
        return $this->request->limit ?: self::DEFAULT_LIMIT;
    }
}
