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
        $this->x_values = $this->createArrayValues( $x_values );
    }


    /**
     * @param  CoefficientsProviderInterface $coefficients_provider
     * @param  array|Traversable $x_values Default x values
     * @return array                                                Interpolated values
     */
    public function __invoke( CoefficientsProviderInterface $coefficients_provider, $x_values = null )
    {
        if (!is_null($x_values))
            $x_values = $this->createArrayValues( $x_values );
        else
            $x_values = $this->x_values;

        $coefficients = $coefficients_provider->getCoefficients();

        return array_map(function($x) use ($coefficients) {
            return PolynomialRegression::interpolate( $coefficients, $x);
        }, $x_values);
    }


    /**
     * @param  mixed $x_values Array or Traversable
     * @return array
     * @throws InvalidArgumentException
     */
    protected function createArrayValues( $x_values )
    {
        if (is_array($x_values))
            return $x_values;

        if ($x_values instanceOf \Traversable)
            return iterator_to_array($x_values);

        throw new \InvalidArgumentException("Array or Traversable expected");

    }

}
