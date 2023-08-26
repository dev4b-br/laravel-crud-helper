<?php

namespace Dev4b\LaravelCrudHelper\Inputs;

class ZipCodeInput extends TextInput
{
    protected array $maskBlocks = [5, 3];

    protected ?array $maskDelimiter = ['-'];

    protected bool $isNumericalOnly = true;

    private bool $autofill;

    private $addressInputName = 'address';

    private $neighborhoodInputName = 'neighborhood';

    private $cityInputName = 'city';

    private $stateInputName = 'state';

    private $countryInputName = 'country';

    public function __construct(string $name, ?string $label = null, ?string $value = null, ?string $placeholder = null, ?string $id = null, bool $autofill = true)
    {
        parent::__construct($name, $label, $value, $placeholder, $id);
        $this->template = 'laravel-crud-helper::inputs.zipCode';
        $this->autofill = $autofill;
    }

    public function render()
    {
        $view = parent::render();
        $view->with('autofill', $this->autofill)
            ->with('addressInputName', $this->addressInputName)
            ->with('neighborhoodInputName', $this->neighborhoodInputName)
            ->with('cityInputName', $this->cityInputName)
            ->with('stateInputName', $this->stateInputName)
            ->with('countryInputName', $this->countryInputName);

        return $view;
    }

    /**
     * @param string $addressInputName
     */
    public function setAddressInputName(string $addressInputName): void
    {
        $this->addressInputName = $addressInputName;
    }

    /**
     * @param string $neighborhoodInputName
     */
    public function setNeighborhoodInputName(string $neighborhoodInputName): void
    {
        $this->neighborhoodInputName = $neighborhoodInputName;
    }

    /**
     * @param string $cityInputName
     */
    public function setCityInputName(string $cityInputName): void
    {
        $this->cityInputName = $cityInputName;
    }

    /**
     * @param string $stateInputName
     */
    public function setStateInputName(string $stateInputName): void
    {
        $this->stateInputName = $stateInputName;
    }

    /**
     * @param string $countryInputName
     */
    public function setCountryInputName(string $countryInputName): void
    {
        $this->countryInputName = $countryInputName;
    }
}
