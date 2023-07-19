<?php

namespace Dev4b\LaravelCrudHelper\Concerns;

trait HasOld
{
    protected ?string $oldKey = null;

    public function handleOld(bool $useOld, ?string $key)
    {
        $this->oldKey = $useOld ? $key : null;
    }
}
