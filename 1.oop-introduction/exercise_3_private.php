<?php

declare(strict_types=1);

/* EXERCISE 3

TODO: Copy the code of exercise 2 to here and delete everything related to cola.
TODO: Make all properties private.
TODO: Make all the other prints work without error.
TODO: After fixing the errors. Change the color of Duvel to light instead of blond and also print this new color on the screen after all the other things that were already printed (to be sure that the color has changed).
TODO: Create a new private method in the Beer class called beerInfo which returns "Hi i'm Duvel and have an alcochol percentage of 8.5 and I have a light color."

Make sure that you use the variables and not just this text line.

TODO: Print this method on the screen on a new line.

USE TYPEHINTING EVERYWHERE!
*/

class Bevrage
{

    private string $color;
    private float $price;
    private string $temperature;

    public function __construct(string $color, float $price, string $temperature = 'cold')
    {
        $this->color = $color;
        $this->price = $price;
        $this->temperature = $temperature;
    }

    public function getInfo()
    {
        echo "<p>This beverage is {$this->temperature} and {$this->color}.</p>";
    }

    public function getTemperature()  {
        return $this->temperature;
    }
    public function getColor()  {
        return $this->color;
    }
}

class Beer extends Bevrage
{

    private string $name;
    private float $alcoholPercentage;

    public function __construct(string $color, float $price, string $name, float $alcoholPercentage ,  string $temperature = 'cold')
    {

        parent::__construct($color, $price, $temperature);
        $this->name = $name;
        $this->alcoholPercentage = $alcoholPercentage;
    }

    public function getAlcoholPercentage()
    {
        echo "<p>This alcohol percentage is {$this->alcoholPercentage}%.</p>";
    }

    public function getAlcohol(){
       return  $this->alcoholPercentage;
    }

    public function setColor(string $newColor)
    {
        return $this->color = $newColor;
    }

    private function beerInfo() {
       return "Hi i'm {$this->name} and have an alcochol percentage of {$this->alcoholPercentage} and I have a {$this->getColor()} color.";
    }
    public function publicBeerInfo(){
        echo $this->beerInfo();
    }
}

$duvel = new Beer('blond', 3.5,'Duvel',8.5);
$duvel->getAlcoholPercentage();
echo "<p>{$duvel->getAlcohol()}%</p>";
echo "<p>{$duvel->getTemperature()}</p>";
$duvel->getInfo();

$error = new Bevrage('blond', 3.5,'Duvel',8.5);
$duvel->setColor('light');
echo $duvel->publicBeerInfo();