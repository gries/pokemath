<?php

namespace spec\gries\Pokemath;

use gries\NumberSystem\Number;
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
            ->shouldBe('The value is: 701')
        ;
    }

    function it_translates_pokenumbers_of_a_expression_with_no_spaces()
    {
        $this
            ->translate('volcanion + ivysaur')
            ->shouldBe('699 + 1')
        ;
    }

    function it_translates_pokenumber_in_a_complex_expression()
    {
        $this
            ->translate('(bulbasaur + ivysaur) * ivysaur#ivysaur')
            ->shouldBe('(0 + 1) * 701')
        ;
    }

    function it_calculates_expressions()
    {

        $this
            ->calculate('(ivysaur + ivysaur) * ivysaur#ivysaur')  // (1+1) * 701 = 1402
            ->shouldHaveADecimalValueOf(1402)
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
