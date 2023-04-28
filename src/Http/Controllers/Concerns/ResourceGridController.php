<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers\Concerns;

use Dev4b\LaravelCrudHelper\Forms\AbstractResourceForm;
use Illuminate\Http\Request;

trait ResourceGridController
{
    public function getGrid(Request $request): AbstractResourceForm
    {
        throw new \Exception('Método precisa ser implementado');
    }

    public function index()
    {

    }

    public function show(string $id)
    {
        throw new \Exception('Not implemented yet');
    }

    public function destroy(string $id)
    {
        throw new \Exception('Not implemented yet');
    }
}
