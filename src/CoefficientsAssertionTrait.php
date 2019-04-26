<?php
namespace FilmTools\PolynomialModel;

trait CoefficientsAssertionTrait
{
    protected function assertCoefficients( $coefficients ) : iterable
    {
        if ($coefficients instanceOf CoefficientsProviderInterface)
            return $coefficients->getCoefficients();

        elseif ($coefficients instanceOf \SplFixedArray )
            return $coefficients;

        elseif (is_iterable($coefficients))
            return \SplFixedArray::fromArray( iterable_to_array($coefficients));

        throw new \InvalidArgumentException("Iterable or CoefficientsProviderInterface expected");
    }   
}