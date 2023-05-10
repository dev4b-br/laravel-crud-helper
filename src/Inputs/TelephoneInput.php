<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class TelephoneInput extends CellphoneInput
{
    protected array $maskBlocks = [0,2,0,4,4];
}
