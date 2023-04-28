<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers\Concerns;

use Dev4b\LaravelCrudHelper\Forms\AbstractResourceForm;
use Illuminate\Http\Request;

trait ResourceFormController
{
    public function getForm(Request $request): AbstractResourceForm
    {
        throw new \Exception('Método precisa ser implementado');
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
}
