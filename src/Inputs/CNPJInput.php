<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class CNPJInput extends TextInput
{
    protected array $maskBlocks = [2, 3, 3, 4, 2];

    protected ?array $maskDelimiter = ['.', '.', '/', '-'];

    protected bool $isNumericalOnly = true;
}
