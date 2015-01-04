<?php

namespace spec\gries\Pokemath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PokeNumberSystemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('gries\Pokemath\PokeNumberSystem');
    }
}
