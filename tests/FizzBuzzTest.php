<?php

use App\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /** @test */
    function if_returns_fizz_for_multiples_of_three()
    {
        foreach ([3,6,9,12] as $number) {
            $this->assertEquals('Fizz', FizzBuzz::convert($number));
        }
    }


    /** @test */
    function if_returns_buzz_for_multiples_of_five()
    {
        foreach ([5, 10, 20, 25] as $number) {
            $this->assertEquals('Buzz', FizzBuzz::convert($number));
        }
    }


    /** @test */
    function if_returns_fizzbuzz_for_multiples_of_three_and_five()
    {
        foreach ([15, 30, 45, 60] as $number) {
            $this->assertEquals('FizzBuzz', FizzBuzz::convert($number));
        }
    }

    /** @test */
    function if_returns_the_original_number_if_not_divisible_by_three_or_five()
    {
        foreach ([1, 2, 7, 8, 11] as $number) {
            $this->assertEquals($number, FizzBuzz::convert($number));
        }
    }
}
