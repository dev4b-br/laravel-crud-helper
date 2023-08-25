<?php

namespace Dev4b\LaravelCrudHelper\Forms\Concerns;

use Dev4b\LaravelCrudHelper\Contracts\Fileable;

trait HasFile
{
    public function handleFiles($files, Fileable $model)
    {
        foreach ($files as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('files', $fileName, 'public');
            $url = "/storage/{$path}";

            $model->files()->create([
                'url' => $url,
            ]);
        }
    }
}
