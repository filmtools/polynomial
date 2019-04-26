<?php
namespace FilmTools\PolynomialModel;

trait CoefficientsProviderTrait
{

    /**
     * The polynomial coefficients
     * @var iterable
     */
    public $coefficients = array();


    /**
     * Returns the polynomial coefficients
     * @return array
     */
    public function getCoefficients(): iterable
    {
        return $this->coefficients;
    }
}
