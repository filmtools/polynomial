<?php
namespace FilmTools\PolynomialModel;

use DrQue\PolynomialRegression;

class MultipleInterpolator implements CoefficientsProviderInterface
{
    use CoefficientsProviderTrait;


    /**
     * @param  array|CoefficientsProviderInterface $coefficients
     */
    public function __construct( $coefficients )
    {
        $this->coefficients = $this->assertCoefficients( $coefficients );
    }

    /**
     * @param iterable $x_values Default x values
     */
    public function __invoke( $x_values )
    {
        return $this->interpolate( $x_values );
    }


    /**
     * @param iterable $x_values Default x values
     */
    public function interpolate( iterable $x_values ) : array
    {
        $x_values = iterable_to_array( $x_values );
        $coefficients = $this->getCoefficients();

        return array_map(function($x) use ($coefficients) {
            return PolynomialRegression::interpolate( $coefficients, $x);
        }, $x_values);
    }


    protected function assertCoefficients( $coefficients ) : iterable
    {
        if ($coefficients instanceOf CoefficientsProviderInterface)
            return $coefficients->getCoefficients();

        elseif (is_iterable($coefficients))
            return \SplFixedArray::fromArray( iterable_to_array($coefficients));

        throw new \InvalidArgumentException("Iterable or CoefficientsProviderInterface expected");
    }

}
