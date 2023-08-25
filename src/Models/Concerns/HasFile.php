<?php

namespace Dev4b\LaravelCrudHelper\Models\Concerns;

trait HasFile
{
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
