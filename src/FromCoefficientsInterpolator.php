<?php
namespace FilmTools\PolynomialModel;

use DrQue\PolynomialRegression;

class FromCoefficientsInterpolator
{
    use CoefficientsAssertionTrait;

    /**
     * @var \SplFixedArray
     */
    public $x_values;


    /**
     * @param iterable $x_values Default x values
     */
    public function __construct( iterable $x_values = array())
    {
        $this->x_values = \SplFixedArray::fromArray(iterable_to_array( $x_values ));
    }


    /**
     * @param  iterable|CoefficientsProviderInterface $coefficients
     * @param  iterable                               $x_values Default x values
     * @return array Interpolated values
     */
    public function __invoke( $coefficients, iterable $x_values = null ) : iterable
    {
        $coefficients = $this->assertCoefficients( $coefficients );

        $x_values = is_null($x_values)
        ? $this->x_values
        : \SplFixedArray::fromArray(iterable_to_array( $x_values ));

        $results = array();
        foreach($x_values as $x)
            $results[] = PolynomialRegression::interpolate( $coefficients, $x);
        return $results;
    }


}
