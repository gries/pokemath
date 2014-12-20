<?php
namespace gries\Pokemath;

use gries\NumberSystem\Number;

class PokeNumber extends Number
{
    public function __construct($value)
    {
        parent::__construct($value, new PokeNumberSystem());
    }
}
