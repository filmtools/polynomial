<?php
namespace FilmTools\PolynomialModel;

trait CoefficientsProviderTrait
{

    /**
     * The polynomial coefficients.
     *
     * @var \SplFixedArray
     */
    protected $coefficients;


    /**
     * Returns the polynomial coefficients.
     * @return array
     */
    public function getCoefficients(): \SplFixedArray
    {
        return $this->coefficients instanceOf \SplFixedArray
        ? $this->coefficients
        : new \SplFixedArray( 0 );
    }
}
