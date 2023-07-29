<?php

namespace Dev4b\LaravelCrudHelper\Concerns;

use Illuminate\Contracts\Support\Renderable;

interface Content extends Renderable
{
    public function render();
}
