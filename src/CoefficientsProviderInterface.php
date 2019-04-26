<?php
namespace FilmTools\PolynomialModel;

interface CoefficientsProviderInterface
{

    /**
     * Returns the coefficients of the polynomial model.
     *
     * @return \SplFixedArray
     */
    public function getCoefficients(): \SplFixedArray;

}
