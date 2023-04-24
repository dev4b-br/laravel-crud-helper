<?php

namespace Dev4b\LaravelCrudHelper\Forms\Contracts;

use Illuminate\Http\Request;

interface HasValidation
{
    public function getValidationRequest(Request $request): Request;
}
