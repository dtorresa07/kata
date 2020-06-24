<?php


namespace App;


class FizzBuzz
{

    public static function convert(int $number)
    {
        $result = '';


        if ($number % 3 === 0){
            $result .= "Fizz";
        }

        if ($number % 5 === 0){
            $result .= "Buzz";
        }

        return $result ?: $number;
    }
}