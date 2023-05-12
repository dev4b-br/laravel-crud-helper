<?php

namespace Dev4b\LaravelCrudHelper\Grids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GridColumn
{
    protected string $name;

    protected bool $isSortable = false;

    protected string $head = '';
    private $resourceName;

    public function __construct($name, $head = '', $isSortable = false, $resourceName = null)
    {
        $this->name = $name;
        $this->isSortable = $isSortable;
        $this->head = $head;
        $this->resourceName = $resourceName;
    }

    public function getData($columnName, $data)
    {
        if ($columnName == 'actions') {
            return view('laravel-crud-helper::rowActions')
                ->with('updateUrl', $this->getUpdateUrl($data))
                ->with('deleteUrl', $this->getDeleteUrl($data));
        }

        return $data[$columnName];
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
