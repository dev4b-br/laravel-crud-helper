<?php

namespace Dev4b\LaravelCrudHelper\Concerns;

trait HasHint
{
    protected mixed $hint = null;

    public function setHint($hint)
    {
        $this->hint = $hint;
    }
}
