<?php
namespace FilmTools\PolynomialModel;

use DrQue\PolynomialRegression;

class FromCoefficientsInterpolator
{

    /**
     * @var iterable
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
