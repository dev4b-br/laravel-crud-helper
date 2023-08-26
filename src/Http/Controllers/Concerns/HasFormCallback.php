<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers\Concerns;

use Dev4b\LaravelCrudHelper\Forms\AbstractResourceForm;
use Illuminate\Http\Request;

trait HasFormCallback
{
    public function formCallback(Request $request)
    {
        $form = $this->getForm();
        return $form->changeFieldCallback($request);
    }
}
