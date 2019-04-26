<?php
namespace FilmTools\PolynomialModel;

class DerivativeCoefficientsProvider implements CoefficientsProviderInterface
{

    /**
     * @var CoefficientsProviderInterface
     */
    protected $coefficients_provider;

    public function __construct( CoefficientsProviderInterface $coefficients_provider )
    {
        $this->coefficients_provider = $coefficients_provider;
    }


    /**
     * Returns the coefficients for a derivation.
     * @inheritDoc
     */
    public function getCoefficients() : \SplFixedArray
    {
        $coefficients = $this->coefficients_provider->getCoefficients();
        $coefficients = iterable_to_array( $coefficients );

        // In derivatives, the last coefficient is ignored
        if (array_key_exists(0, $coefficients))
            unset($coefficients[0]);

        // Hmmm. Should it be empty?
        if (count($coefficients) === 0)
            return new \SplFixedArray( 0 );

        // Perform the derivation
        $new_coefficients = array(0);
        foreach($coefficients as $exponent => $factor)
            $new_coefficients[ $exponent - 1 ] = $exponent * $factor;

        return \SplFixedArray::fromArray( $new_coefficients );
    }

}
