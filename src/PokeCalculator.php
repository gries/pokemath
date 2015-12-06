<?php

namespace gries\Pokemath;

use gries\NumberSystem\Exception\NumberParseException;
use gries\NumberSystem\Expression;
use gries\NumberSystem\ExpressionConverter;
use gries\NumberSystem\Number;
use gries\NumberSystem\NumberSystem;

/**
 * Class PokeCalculator
 *
 * The PokeCalculator can be used to translate or calculate mathematical expressions
 * that use the Pokemath Numbersystem.
 *
 * @package gries\Pokemath
 */
class PokeCalculator
{
    const INPUT_DECIMAL = 'decimal';
    const INPUT_POKENUMBER = 'pokenumber';

    /**
     * @var PokeNumberSystem
     */
    protected $numberSystem;

    /**
     * @var ExpressionConverter
     */
    protected $converter;

    public function __construct()
    {
        $this->numberSystem = new PokeNumberSystem();
        $this->converter = new ExpressionConverter();
    }

    /**
     * Translate all PokeNumbers found inside of an expression to decimal numbers.
     * Note: Only expression that use spaces to seperate strings can be parsed
     * This means: "snorlax+jigglypuff" will NOT be recognised whereas "snorlax + jigglypuff" will be parseable.
     *
     * @param string $expression
     *
     * @return string
     */
    public function translate($expression, $inputFormat = self::INPUT_POKENUMBER)
    {
        $inputSystem = $this->numberSystem;
        $outputSystem = new NumberSystem();

        if ($inputFormat === self::INPUT_DECIMAL) {
            $inputSystem = new NumberSystem();
            $outputSystem = $this->numberSystem;
        }

        $expression = new Expression($expression, $inputSystem);

        return $this->converter->convert($expression, $outputSystem)->value();
    }

    /**
     * Calculate a mathematical expression that uses pokemath-numbers
     *
     * @param $expression
     *
     * @return Number
     */
    public function calculate($expression)
    {
        $translatedExpression = $this->translate($expression);
        $result = eval('return '.$translatedExpression.';');

        $decimalResult = new Number($result); // this is bad and needs some work

        return $decimalResult->convert($this->numberSystem);
    }
}
