<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers;

use Dev4b\LaravelCrudHelper\Forms\AbstractResourceForm;
use Illuminate\Http\Request;

abstract class AbstractResourceController
{
    abstract public function getForm(Request $request): AbstractResourceForm;

    public function index()
    {

    }

    public function create()
    {
        return $this->getForm(\request())->render();
    }

    public function store(Request $request)
    {
        $form = $this->getForm($request);
        $form->execute($request);
        return redirect($form->getRedirectRoute())->with('asdasdas');
    }

    public function show(string $id)
    {
        throw new \Exception('Not implemented yet');
    }

    public function edit(string $id)
    {
         $form = $this->getForm(\request());
         return $form->render();
    }

    public function update(Request $request, string $id)
    {
        $form = $this->getForm($request);
        $form->execute($request);
        return redirect($form->getRedirectRoute())->with('gggg hhhhh');
    }

    public function destroy(string $id)
    {
        throw new \Exception('Not implemented yet');
    }
}
