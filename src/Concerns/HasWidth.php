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

    public function setColsNumber($colsNumber, $ignoreSmallWidth = false)
    {
        if ($ignoreSmallWidth) {
            $this->addContainerClass('col-md-' . $colsNumber);
            return;
        }

        $this->addContainerClass('col-sm-12 col-md-' . $colsNumber);
    }
}
