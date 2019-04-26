<?php
namespace tests;

use FilmTools\PolynomialModel\MultipleInterpolator;
use FilmTools\PolynomialModel\CoefficientsProviderInterface;

class MultipleInterpolatorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideCoefficients
     */
    public function testInterpolationMethod($coefficients, $values, $expected_result)
    {
        $sut = new MultipleInterpolator($coefficients);

        $result = $sut->interpolate( $values );
        $this->assertINstanceOf(\SplFixedArray::class, $result);
        $this->assertEquals($result, $expected_result);
    }


    /**
     * @dataProvider provideCoefficients
     */
    public function testInvokationMethod($coefficients, $values, $expected_result)
    {
        $sut = new MultipleInterpolator($coefficients);

        $result = $sut( $values );
        $this->assertINstanceOf(\SplFixedArray::class, $result);
        $this->assertEquals($result, $expected_result);
    }


    public function provideCoefficients()
    {
        $values = array(1,2,3);
        $coefficients = array(2, 3);
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
