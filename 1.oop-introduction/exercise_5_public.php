<?php

declare(strict_types=1);

/* EXERCISE 5

Copy the class of exercise 1.

TODO: Change the properties to private.
TODO: Fix the errors without using getter and setter functions.
TODO: Change the price to 3.5 euro and print it also on the screen on a new line.
*/

class Bevrage {

    private string $color;
    private float $price;
    private string $temperature;

    public function __construct(string $color, float $price, string $temperature = 'cold'){
        $this->color = $color;
        $this->price = $price;
        $this->temperature = $temperature;
    }

    public function getInfo(){
        echo "This beverage is {$this->temperature} and {$this->color}.";
    }

    public function bevrageInfo(){
        return $this->getInfo();
    }
}

$cola = new Bevrage('black', 3.5); // Changed price to 3.5
$coffee = new Bevrage('black', 1.00, 'hot');

$cola->bevrageInfo();
$coffee->bevrageInfo();
?>