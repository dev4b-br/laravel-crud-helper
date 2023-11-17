<?php

namespace Dev4b\LaravelCrudHelper\Grids;

class GridColumn
{
    protected string $name;

    protected bool $isSortable = false;

    protected string $head = '';

    private $resourceName;

    protected bool $enabledEditAction = true;

    protected bool $enabledDeleteAction = true;

    public function __construct($name, $head = '', $isSortable = false, $resourceName = null, $enabledEditAction = true, $enabledDeleteAction = true)
    {
        $this->name = $name;
        $this->isSortable = $isSortable;
        $this->head = $head;
        $this->resourceName = $resourceName;
        $this->enabledEditAction = $enabledEditAction;
        $this->enabledDeleteAction = $enabledDeleteAction;
    }

    public function getData($columnName, $data)
    {
        if ($columnName == 'actions') {
            $view = view('laravel-crud-helper::rowActions');

            if ($this->enabledEditAction) {
                $view->with('updateUrl', $this->getUpdateUrl($data));
            }

            if ($this->enabledDeleteAction) {
                $view->with('deleteUrl', $this->getDeleteUrl($data));
            }

            return $view;
        }

        return $data[$columnName];
    }

    public function getSorgingClasses()
    {
        if (!$this->isSortable) {
            return '';
        }

        $request = request();
        $direction = '';
        if (isset($request->order['column']) && $request->order['column'] == $this->name) {
            $direction = $request->order['direction'] == 'asc' ? 'sorting_asc' : ($request->order['direction'] == 'desc' ? 'sorting_desc' : 'sorting_asc');
        }

        return "sorting {$direction}";
    }

    public function getSortUrl()
    {
        $request = request();
        $order['column'] = $this->name;
        $order['direction'] = 'asc';

        if (isset($request->order['column']) && $request->order['column'] == $this->name) {
            $order['direction'] = $request->order['direction'] == 'asc' ? 'desc' : ($request->order['direction'] == 'desc' ? 'asc' : 'desc');
        }

        $orderParam['order'] = $order;

        return '?' . http_build_query(array_merge($request->input(), $orderParam));
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->isSortable;
    }

    /**
     * @param bool $isSortable
     */
    public function setIsSortable(bool $isSortable): void
    {
        $this->isSortable = $isSortable;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @param string $head
     */
    public function setHead(string $head): void
    {
        $this->head = $head;
    }

    private function getUpdateUrl($data)
    {
        $methodName = 'edit';

        return route($this->resourceName . ".{$methodName}", [$data]);
    }

    private function getDeleteUrl($data)
    {
        $methodName = 'destroy';

        return route($this->resourceName . ".{$methodName}", [$data]);
    }
}
