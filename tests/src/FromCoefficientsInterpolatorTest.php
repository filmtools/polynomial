<?php
namespace tests;

use FilmTools\PolynomialModel\FromCoefficientsInterpolator;
use FilmTools\PolynomialModel\CoefficientsProviderInterface;

class FromCoefficientsInterpolatorTest extends \PHPUnit\Framework\TestCase
{
    public function testSimple()
    {
        $coefficients = array(2, 3);

        $cp = $this->prophesize( CoefficientsProviderInterface::class );
        $cp->getCoefficients()->willReturn( $coefficients );
        $cp_stub = $cp->reveal();

        $values = array(1,2,3);
        $sut = new FromCoefficientsInterpolator($values);

        $results = $sut( $cp_stub );
        $this->assertInternalType("array", $results);
        $this->assertEquals($results, [ 5, 8, 11 ]);

        $values = array(2,3,4);
        $result2 = $sut( $cp_stub, $values );
        $this->assertInternalType("array", $result2);
        $this->assertEquals($result2, [ 8, 11, 14 ]);

    }

}
