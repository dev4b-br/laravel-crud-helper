<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers\Concerns;

use Dev4b\LaravelCrudHelper\Grids\AbstractResourceGrid;
use Illuminate\Http\Request;

trait ResourceGridController
{
    public function getGrid(Request $request): AbstractResourceGrid
    {
        throw new \Exception('Método precisa ser implementado');
    }

    public function index()
    {
        return $this->getGrid(\request())->render();
    }

    public function exportData(string $type)
    {
        return $this->getGrid(\request())->export($type);
    }

    public function show(string $id)
    {
        throw new \Exception('Not implemented yet');
    }

    public function destroy(Request $request)
    {
        $this->getResource($request)->delete();
        return redirect($this->getGrid($request)->getRedirectRoute())->with('message', $this->getDeletedMessage());
    }

    public function getDeletedMessage()
    {
        return 'Removido com sucesso';
    }
}
