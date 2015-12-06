<?php

namespace spec\gries\Pokemath;

use gries\NumberSystem\Number;
use gries\Pokemath\PokeCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PokeCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('gries\Pokemath\PokeCalculator');
    }

    function it_translates_pokenumbers_of_a_expression()
    {
        $this
            ->translate('The value is: ivysaur#ivysaur')
            ->shouldBe('The value is: 1404')
        ;
    }

    function it_translates_pokenumbers_of_a_expression_with_no_spaces()
    {
        $this
            ->translate('volcanion + ivysaur')
            ->shouldBe('700 + 2')
        ;
    }

    function it_translates_pokenumber_in_a_complex_expression()
    {
        $this
            ->translate('(bulbasaur + ivysaur) * ivysaur#ivysaur')
            ->shouldBe('(1 + 2) * 1404')
        ;
    }

    function it_translates_a_decimal_expression_to_pokenumbers()
    {
        $this
            ->translate('(1 + 2) * 1404', PokeCalculator::INPUT_DECIMAL)
            ->shouldBe('(bulbasaur + ivysaur) * ivysaur#ivysaur')
        ;
    }

    function it_calculates_expressions()
    {

        $this
            ->calculate('(ivysaur + ivysaur) * ivysaur#ivysaur')  // (2+2) * 1404 = 5616 
            ->shouldHaveADecimalValueOf(5616)
        ;
    }

    function getMatchers()
    {
        return [
            'haveADecimalValueOf' => function (Number $actual, $expectedValue) {

                if ($actual->asDecimalString() === $expectedValue) {
                    return true;
                }
                
		return false;
            }
        ];
    }
}
