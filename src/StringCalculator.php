<?php


namespace App;


use Exception;

/**
 * Class StringCalculator
 * @package App
 */

class StringCalculator
{
    /**
     * The max number value allowed on the calculator
     */
    const MAX_NUMBER_ALLOWED = 1000;

    /**
     * The default accepted delimiters for the string
     */
    protected $delimiter = ",|\n";

    /**
     * Takes a string and sums the values
     * @param string $numbers
     * @return float|int
     * @throws Exception
     */
    public function add(string $numbers){

        $numbers = $this->parseString($numbers);

        $this->disallowNegatives($numbers);

        return array_sum(
            $this->ignoreNumbersGreaterThanMaxAllowed($numbers)
        );
    }

    /**
     * Checks for a custom delimiter and parses the string accordingly
     * @param string $numbers
     * @return array
     */

    public function parseString(string $numbers): array
    {
        $custom_delimiter = '\/\/(.)\n';

        if (preg_match("/{$custom_delimiter}/", $numbers, $matches)) {
            $this->delimiter = $matches[1];

            $numbers = str_replace($matches[0], '', $numbers);

        }

        return preg_split("/{$this->delimiter}/", $numbers);

    }

    /**
     * Checks for negatives values on the string and throws exception when found
     * @param $numbers
     * @throws Exception
     */
    public function disallowNegatives($numbers): void
    {
        foreach ($numbers as $number) {

            if ($number < 0) {
                throw new Exception("Negative numbers not allowed");
            }

        }
    }

    /**
     * Checks the values on the string and removes all values that are greater than MAX_NUMBER_ALLOWED
     * @param array $numbers
     * @return array
     */
    public function ignoreNumbersGreaterThanMaxAllowed(array $numbers): array
    {
        return array_filter(
            $numbers, fn($number) => $number <= self::MAX_NUMBER_ALLOWED
        );

    }


}