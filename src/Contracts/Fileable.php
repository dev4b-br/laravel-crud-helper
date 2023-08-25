<?php

namespace Dev4b\LaravelCrudHelper\Contracts;

interface Fileable
{
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany;
}
