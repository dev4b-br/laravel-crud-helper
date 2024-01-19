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

        if ($form->isAjax) {
            \Session::flash('message', $this->getCreatedMessage());

            return response()->json([
                'success' => true,
                'message' => $this->getCreatedMessage(),
                'redirect' => $form->getRedirectRoute(),
            ]);
        }

        return redirect($form->getRedirectRoute())->with('message', $this->getCreatedMessage());
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

        if ($form->isAjax) {
            \Session::flash('message', $this->getUpdatedMessage());

            return response()->json([
                'success' => true,
                'message' => $this->getUpdatedMessage(),
                'redirect' => $form->getRedirectRoute(),
            ]);
        }
        return redirect($form->getRedirectRoute())->with('message', $this->getUpdatedMessage());
    }

    public function getCreatedMessage()
    {
        return 'Criado com sucesso';
    }

    public function getUpdatedMessage()
    {
        return 'Atualizado com sucesso';
    }
}
