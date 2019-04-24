<?php
namespace FilmTools\PolynomialModel;

class DerivativeCoefficientsProvider implements CoefficientsProviderInterface
{

    protected $coefficients_provider;

    public function __construct( CoefficientsProviderInterface $coefficients_provider )
    {
        $this->coefficients_provider = $coefficients_provider;
    }


    /**
     * Returns the coefficients for a derivation.
     * @inheritDoc
     */
    public function getCoefficients(): array
    {
        $coefficients = $this->coefficients_provider->getCoefficients();

        if (array_key_exists(0, $coefficients))
            unset($coefficients[0]);

        $new_coefficients = array();
        foreach($coefficients as $exponent => $factor)
            $new_coefficients[ $exponent - 1 ] = $exponent * $factor;

        return $new_coefficients;
    }

}
