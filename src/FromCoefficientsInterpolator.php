<?php
namespace FilmTools\PolynomialModel;

use DrQue\PolynomialRegression;

class FromCoefficientsInterpolator
{

    /**
     * @var array
     */
    public $x_values;


    /**
     * @param array|Traversable $x_values Default x values
     */
    public function __construct( $x_values = array())
    {
        $this->x_values = $this->assertArrayValues( $x_values );
    }


    /**
     * @param  array|CoefficientsProviderInterface $coefficients
     * @param  array|Traversable $x_values Default x values
     * @return array Interpolated values
     */
    public function __invoke( $coefficients, $x_values = null )
    {

        $coefficients = $this->assertCoefficients( $coefficients );
        $x_values = $this->assertArrayValues( $x_values );

        return array_map(function($x) use ($coefficients) {
            return PolynomialRegression::interpolate( $coefficients, $x);
        }, $x_values);
    }


    protected function assertCoefficients( $coefficients ) : array
    {
        if ($coefficients instanceOf CoefficientsProviderInterface)
            $coefficients = $coefficients->getCoefficients();
        elseif (!is_array($coefficients))
            throw new \InvalidArgumentException("Array or CoefficientsProviderInterface expected");

        return $coefficients;
    }

    /**
     * @param  mixed $x_values
     * @return array
     * @throws InvalidArgumentException
     */
    protected function assertArrayValues( $x_values ) : array
    {
        if (is_array($x_values))
            return $x_values;

        if ($x_values instanceOf \Traversable)
            return iterator_to_array($x_values);

        if (is_null($x_values))
            return $this->x_values;

        throw new \InvalidArgumentException("Array, Traversable, or NULL expected");

    }

}
