<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Dev4b\LaravelCrudHelper\Forms\Contracts\HasValidation;
use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractResourceForm
{
    protected Model $resource;

    private array $inputs = [];

    private string $parentView;

    public function __construct(Model $resource, $parentView)
    {
        $this->resource = $resource;
        $this->parentView = $parentView;
        $this->setup();
    }

    abstract protected function setup();

    public function view(): View
    {
        return view('laravel-crud-helper::form')
            ->with('inputs', $this->inputs)
            ->with('action', $this->getAction())
            ->with('submitText', $this->getSubmitText())
            ->with('resource', $this->resource)
            ->with('parentView', $this->parentView);
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
        $resourceName = $this->getResourceName();
        if ($this->isANewResource()) {
            $methodName = 'store';
        } else {
            $methodName = 'update';
        }

        return route($resourceName . ".{$methodName}", $this->getRouteParams());
    }

    private function getSubmitText()
    {
        if ($this->isANewResource()) {
            return $this->getCreateSubmitButtonText();
        }

        return $this->getUpdateSubmitButtonText();
    }

    private function isANewResource()
    {
        return ! $this->resource->exists;
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
