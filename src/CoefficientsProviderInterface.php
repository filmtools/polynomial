<?php
namespace FilmTools\PolynomialModel;

interface CoefficientsProviderInterface
{

    /**
     * Returns the coefficients of the polynomial model.
     *
     * @return iterable
     */
    public function getCoefficients(): iterable;

}
