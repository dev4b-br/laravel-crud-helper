<?php

namespace Dev4b\LaravelCrudHelper\Concerns;

abstract class AbstractBlock implements Content
{
    protected array $containerClasses = [];

    public function addContainerClass($class)
    {
        $this->containerClasses[] = $class;
    }
}
