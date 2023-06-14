<?php

namespace Dev4b\LaravelCrudHelper\Concerns;

trait HasWidth
{
    public function setHalf()
    {
        $this->addContainerClass('col-6');
    }

    public function setTriple()
    {
        $this->addContainerClass('col-4');
    }

    public function setQuadruple()
    {
        $this->addContainerClass('col-3');
    }
}
