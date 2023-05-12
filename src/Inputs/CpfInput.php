<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class CpfInput extends TextInput
{
    protected array $maskBlocks = [3,3,3,2];

    protected ?array $maskDelimiter = ['.','.','-'];

    protected bool $isNumericalOnly = true;
}
