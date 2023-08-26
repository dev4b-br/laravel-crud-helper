<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers;

use Dev4b\LaravelCrudHelper\Http\Controllers\Concerns\ResourceFormController;
use Dev4b\LaravelCrudHelper\Http\Controllers\Concerns\ResourceGridController;
use Illuminate\Http\Request;

abstract class AbstractResourceController
{
    use ResourceFormController, ResourceGridController;


    public function getResource(Request $request)
    {
        throw new \Exception('Método precisa ser implementado');
    }
}
