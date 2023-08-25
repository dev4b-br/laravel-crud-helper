<?php

namespace Dev4b\LaravelCrudHelper\Models\Concerns;

use App\Models\File;

trait HasFile
{
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
