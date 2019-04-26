<?php
namespace FilmTools\PolynomialModel;

use DrQue\PolynomialRegression;

class MultipleInterpolator implements CoefficientsProviderInterface
{
    use CoefficientsProviderTrait,
        CoefficientsAssertionTrait;


    /**
     * @param  iterable|CoefficientsProviderInterface $coefficients
     */
    public function __construct( $coefficients )
    {
        $this->coefficients = $this->assertCoefficients( $coefficients );
    }


    /**
     * @param iterable $x_values Default x values
     */
    public function __invoke( iterable $x_values )
    {
        return $this->interpolate( $x_values );
    }


    /**
     * @param iterable $x_values Default x values
     * @return SplFixedArray
     */
    public function interpolate( iterable $x_values ) : \SplFixedArray
    {
        $coefficients = $this->getCoefficients();

        $results = iterable_map($x_values, function($x) use ($coefficients) {
            return PolynomialRegression::interpolate( $coefficients, $x);
        });

        return \SplFixedArray::fromArray(iterable_to_array( $results ));
    }


}
