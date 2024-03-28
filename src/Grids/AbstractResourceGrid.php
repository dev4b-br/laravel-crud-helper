<?php

namespace Dev4b\LaravelCrudHelper\Grids;

use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

abstract class AbstractResourceGrid
{
    const DEFAULT_LIMIT = 10;

    protected Model $resource;

    protected string $parentView;

    protected string $exportView;

    protected Request $request;

    protected array $columns = [];

    protected array $filters = [];

    protected bool $exportCsv = false;

    protected bool $exportPdf = false;

    protected string $gridTitle = '';

	protected string $defaultButtonTitle = '';

	protected string $defaultButtonRoute = '';

    protected string $modalButtonTitle = '';

    protected string $modalRoute = '';

    protected $backLinkUrl;

    protected $template = 'laravel-crud-helper::grid';

	protected bool $enabledDefaultButton = false;

    protected bool $enabledModalButton = false;

    protected $enabledCreateAction = true;

    protected $enabledEditAction = true;

    protected $enabledDeleteAction = true;

    protected $breadcrumbs = '';

    public function __construct(Model $resource, $parentView, Request $request, $actionsColumn = true)
    {
        $this->resource = $resource;
        $this->parentView = $parentView;
        $this->request = $request;
        $this->setup();
        if ($actionsColumn && ($this->enabledEditAction || $this->enabledDeleteAction)) {
            $this->addColumn(new GridColumn('actions', 'Ações', false, $this->getResourceName(), $this->enabledEditAction, $this->enabledDeleteAction));
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
        return view($this->template)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('filters', $this->filters)
            ->with('parentView', $this->parentView)
            ->with('data', $data)
            ->with('columns', $this->columns)
            ->with('exportCsv', $this->exportCsv)
            ->with('exportPdf', $this->exportPdf)
			->with('enabledDefaultButton', $this->enabledDefaultButton)
			->with('defaultButtonTitle', $this->defaultButtonTitle)
			->with('defaultButtonRoute', $this->defaultButtonRoute)
            ->with('enabledModalButton', $this->enabledModalButton)
            ->with('modalButtonTitle', $this->modalButtonTitle)
            ->with('modalRoute', $this->modalRoute)
            ->with('limit', $this->getLimit())
            ->with('gridTitle', $this->gridTitle)
            ->with('backLinkUrl', $this->backLinkUrl)
            ->with('gridClass', $this)
            ->with('enabledCreateAction', $this->enabledCreateAction);
    }

    public function render(): string
    {
        return $this->view()->render();
    }

    protected function disableCreateAction()
    {
        $this->enabledCreateAction = false;
    }

    protected function disableEditAction()
    {
        $this->enabledEditAction = false;
    }

    protected function disableDeleteAction()
    {
        $this->enabledDeleteAction = false;
    }

    protected function getResourceName()
    {
        $className = explode('\\', get_class($this->resource));
        return Str::plural(Str::lower(end($className)));
    }

    public function getRowUrl($row)
    {

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

    public function addContentBlock(Renderable $contentBlock)
    {
        $this->filters[] = $contentBlock;
    }

    public function enableExportCsv(): void
    {
        $this->exportCsv = true;
    }

    public function enableExportPdf(): void
    {
        $this->exportPdf = true;
    }

	public function enableDefaultButton(string $defaultButtonTitle, string $defaultButtonRoute): void
	{
		$this->enabledDefaultButton = true;
		$this->defaultButtonTitle = $defaultButtonTitle;
		$this->defaultButtonRoute = $defaultButtonRoute;
	}

    public function enableModalButton(string $modalButtonTitle, string $modalRoute): void
    {
        $this->enabledModalButton = true;
        $this->modalButtonTitle = $modalButtonTitle;
        $this->modalRoute = $modalRoute;
    }

    public function setExportView(string $exportView): void
    {
        $this->exportView = $exportView;
    }

    public function export(string $type)
    {
        $queryBuilder = $this->getQueryBuilder();
        $this->applyFilters($queryBuilder, $this->request);
        $data = $queryBuilder->get();

        if ($type == 'csv') {
            return $this->exportCsv($data);
        }

        if ($type == 'pdf') {
            return $this->exportPdf($data);
        }

        return null;
    }

    public function exportCsv($data)
    {
        $csvData = [];
        $columnsArray = [];
        foreach ($this->columns as $column) {
            if ($column->getName() == 'actions') {
                continue;
            }
            $columnsArray[] = $column->getHead();
        }
        $csvData[] = implode(',', $columnsArray);

        foreach ($data as $item) {
            $itemsArray = [];
            foreach ($this->columns as $column) {
                if ($column->getName() == 'actions') {
                    continue;
                }
                $itemsArray[] = "'" . $column->getData($column->getName(), $item) . "'";
            }
            $csvData[] = implode(',', $itemsArray);
        }

        $csvText = '';
        foreach ($csvData as $row) {
            $csvText .= $row . PHP_EOL;
        }

        return response()->streamDownload(function () use ($csvText) {
            echo $csvText;
        }, $this->getResourceName() . '.csv');
    }

    public function exportPdf($data)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdfData = [
            'items' => $data,
            'columns' => $this->columns,
            'exportView' => $this->exportView,
        ];
        $pdf->loadView('laravel-crud-helper::export-table', $pdfData);

        return $pdf->stream();
    }

    private function getLimit()
    {
        return $this->request->limit ?: self::DEFAULT_LIMIT;
    }
}
