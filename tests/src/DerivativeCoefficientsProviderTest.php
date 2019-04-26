<?php
namespace tests;

use FilmTools\PolynomialModel\DerivativeCoefficientsProvider;
use FilmTools\PolynomialModel\PolynomialModelInterface;
use FilmTools\PolynomialModel\CoefficientsProviderInterface;
use FilmTools\PolynomialModel\MultipleInterpolator;


class DerivativeCoefficientsProviderTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideCoefficients
     */
    public function testSimple( $c0, $expected_c1)
    {
        $c0 = \SplFixedArray::fromArray( $c0 );
        $expected_c1 = \SplFixedArray::fromArray( $expected_c1 );

        $pm = $this->prophesize( CoefficientsProviderInterface::class );
        $pm->getCoefficients()->willReturn($c0);
        $sut = new DerivativeCoefficientsProvider( $pm->reveal() );

        $c1 = $sut->getCoefficients();
        $this->assertEquals( $expected_c1, $c1);
    }

    public function provideCoefficients()
    {
        return array(
            [ array(0 => 16, 1=>30, 2=>5, 3=> 18 ), array( 0 => 30, 1 => 10, 2 => 54) ],
            [ array(), array() ],
            [ array(0 => 16, 2=>5, 3=> 18 ), array( 0 => 0, 1 => 10, 2 => 54) ]
        );
    }

}
