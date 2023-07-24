<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Dev4b\LaravelCrudHelper\Forms\Contracts\HasValidation;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractResourceForm extends AbstractForm
{
    protected Model $resource;

    public function __construct(Model $resource, ?string $parentView = null)
    {
        $this->resource = $resource;
        parent::__construct($parentView);
    }

    abstract protected function setup();

    public function view(): View
    {
        $view = parent::view();
        return $view->with('resource', $this->resource)
            ->with('gridRoute', $this->getGridRoute());
    }

    public function execute(Request $request)
    {
        if (is_a($this, HasValidation::class)) {
            $this->getValidationRequest($request);
        }

        $data = $request->only($this->resource->getFillable());
        $this->resource->fill($data);
        return $this->resource->save();
    }

    public function getGridRoute()
    {
        $resourceName = $this->getResourceName();

        return route($resourceName . ".index");
    }

    protected function getAction(): string
    {
        $resourceName = $this->getResourceName();
        if ($this->isANewResource()) {
            $methodName = 'store';
        } else {
            $methodName = 'update';
        }

        return route($resourceName . ".{$methodName}", $this->getRouteParams());
    }

    protected function getSubmitText()
    {
        if ($this->isANewResource()) {
            return $this->getCreateSubmitButtonText();
        }

        return $this->getUpdateSubmitButtonText();
    }

    private function isANewResource()
    {
        return !$this->resource->exists;
    }

    protected function getCreateSubmitButtonText()
    {
        return 'Salvar';
    }

    protected function getUpdateSubmitButtonText()
    {
        return 'Atualizar';
    }

    private function getResourceName()
    {
        $className = explode('\\', get_class($this->resource));
        return Str::plural(Str::lower(end($className)));
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
