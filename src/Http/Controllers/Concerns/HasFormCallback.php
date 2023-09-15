<?php

namespace Dev4b\LaravelCrudHelper\Http\Controllers\Concerns;

use Illuminate\Http\Request;

trait HasFormCallback
{
    public function formCallback(Request $request)
    {
        $form = $this->getForm($request);
        return $form->changeFieldCallback($request);
    }
}
