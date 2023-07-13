<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\Content;

class LineBreak implements Content
{
    public function render()
    {
        return view('laravel-crud-helper::content-blocks.lineBreak');
    }
}
