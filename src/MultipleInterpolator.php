<?php
namespace FilmTools\PolynomialModel;

use DrQue\PolynomialRegression;

class MultipleInterpolator implements CoefficientsProviderInterface
{
    use CoefficientsProviderTrait;


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
