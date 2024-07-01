<?php

declare(strict_types=1);

/* EXERCISE 4

Copy the code of exercise 3 to here and delete everything related to cola.

TODO: Make all properties protected.
TODO: Make all the other prints work without error without changing the beverage class.
TODO: Don't call getters in de child class.

USE TYPEHINTING EVERYWHERE!
*/

class Bevrage
{

    protected string $color;
    protected  float $price;
    protected  string $temperature;

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

    public function getTemperature()
    {
        return $this->temperature;
    }
    public function getColor()
    {
        return $this->color;
    }
}

class Beer extends Bevrage
{

    protected  string $name;
    protected  float $alcoholPercentage;

    public function __construct(string $color, float $price, string $name, float $alcoholPercentage,  string $temperature = 'cold')
    {

        parent::__construct($color, $price, $temperature);
        $this->name = $name;
        $this->alcoholPercentage = $alcoholPercentage;
    }

    public function getAlcoholPercentage()
    {
        echo "<p>This alcohol percentage is {$this->alcoholPercentage}%.</p>";
    }

    public function getAlcohol()
    {
        return  $this->alcoholPercentage;
    }

    public function setColor(string $newColor)
    {
        return $this->color = $newColor;
    }

    private function beerInfo()
    {
        return "Hi i'm {$this->name} and have an alcochol percentage of {$this->alcoholPercentage} and I have a {$this->getColor()} color.";
    }

    public function publicBeerInfo()
    {
        echo $this->beerInfo();
    }
}

$duvel = new Beer('blond', 3.5, 'Duvel', 8.5);
$duvel->getAlcoholPercentage();
echo "<p>{$duvel->getAlcohol()}%</p>";
echo "<p>{$duvel->getTemperature()}</p>";
$duvel->getInfo();

$error = new Bevrage('blond', 3.5, 'Duvel', 8.5);
$duvel->setColor('light');
echo $duvel->publicBeerInfo();
?>