<?php

namespace spec\gries\Pokemath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PokeNumberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('snorlax');
        $this->shouldHaveType('gries\Pokemath\PokeNumber');
    }
}
