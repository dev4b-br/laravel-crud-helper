<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class CellphoneInput extends TextInput
{
    protected array $maskBlocks = [0,2,0,5,4];

    protected ?array $maskDelimiter = ['(',')',' ','-'];

    protected bool $isNumericalOnly = true;
}
