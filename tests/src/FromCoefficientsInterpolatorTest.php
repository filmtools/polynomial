<?php
namespace tests;

use FilmTools\PolynomialModel\FromCoefficientsInterpolator;
use FilmTools\PolynomialModel\CoefficientsProviderInterface;

class FromCoefficientsInterpolatorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideCoefficients
     */
    public function testValuesInCtor($coefficients, $values, $expected_result)
    {
        $sut = new FromCoefficientsInterpolator($values);

        $results = $sut( $coefficients );
        $this->assertInstanceOf( \SplFixedArray::Class, $results ));
        $this->assertEquals($results, $expected_result);
    }


    /**
     * @dataProvider provideCoefficients
     */
    public function testValuesOnInvokation($coefficients, $values, $expected_result)
    {
        $sut = new FromCoefficientsInterpolator;

        $results = $sut( $coefficients, $values );
        $this->assertTrue( is_iterable( $results ));
        $this->assertInstanceOf( \SplFixedArray::Class, $results ));
        $this->assertEquals($results, $expected_result);
    }


    public function provideCoefficients()
    {
        $values = array(1,2,3);
        $coefficients = \SplFixedArray::fromArray(array(2, 3));
        $results = \SplFixedArray::fromArray([ 5, 8, 11 ]);

        $cp = $this->prophesize( CoefficientsProviderInterface::class );
        $cp->getCoefficients()->willReturn( $coefficients );
        $cp_stub = $cp->reveal();

        return array(
            [ $coefficients, $values, $results],
            [ $cp_stub, $values, $results],
        );
    }


}
