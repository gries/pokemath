<?php

namespace gries\Pokemath;

use gries\NumberSystem\Exception\NumberParseException;
use gries\NumberSystem\Number;

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
    /**
     * @var PokeNumberSystem
     */
    protected $numberSystem;

    public function __construct()
    {
        $this->numberSystem = new PokeNumberSystem();
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
    public function translate($expression)
    {
        $parsingResult      = $expression;
        $cleanedExpression  = preg_replace('/[^a-z#\s]/', '', $expression);
        $expressionParts    = explode(' ', $cleanedExpression);

        foreach ($expressionParts as $part) {
            $parsedPart = $this->parseExpressionPart($part);
            $parsingResult = preg_replace('/'.$part.'/', $parsedPart, $parsingResult, 1);
        }

        return $parsingResult;
    }

    /**
     * Parse the part of a expression.
     *
     * @param $part
     *
     * @return PokeNumber
     */
    protected function parseExpressionPart($part)
    {
        try {
            $number = new PokeNumber($part);

            return $number->asDecimalString();
        } catch (NumberParseException $e) {
            return $part;
        }
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
