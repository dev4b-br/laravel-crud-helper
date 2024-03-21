<?php

namespace Dev4b\LaravelCrudHelper\Concerns;

trait HasWidth
{
    /**
     * @return void
     * @deprecated
     * @see setColsNumber
     */
    public function setHalf()
    {
        $this->addContainerClass('col-6');
    }

    /**
     * @return void
     * @deprecated
     * @see setColsNumber
     */
    public function setTriple()
    {
        $this->addContainerClass('col-4');
    }

    /**
     * @return void
     * @deprecated
     * @see setColsNumber
     */
    public function setQuadruple()
    {
        $this->addContainerClass('col-3');
    }

    public function setColsNumber($colsNumber, $smallColsNumber = 12)
    {
        $this->addContainerClass('col-' . $smallColsNumber . ' col-md-' . $colsNumber);
    }
}
