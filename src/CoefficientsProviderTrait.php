<?php
namespace FilmTools\PolynomialModel;

trait CoefficientsProviderTrait
{

    /**
     * The polynomial coefficients
     * @var array
     */
    public $coefficients = array();


    /**
     * Returns the polynomial coefficients
     * @return array
     */
    public function getCoefficients(): array
    {
        return $this->coefficients;
    }
}
