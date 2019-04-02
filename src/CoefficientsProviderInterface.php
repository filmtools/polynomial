<?php
namespace FilmTools\PolynomialModel;

interface CoefficientsProviderInterface
{

    /**
     * Returns the coefficients of the polynomial model.
     *
     * @return array
     */
    public function getCoefficients(): array;

}
