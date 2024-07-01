<?php

declare(strict_types=1);

/* EXERCISE 7

Copy your solution from exercise 6

TODO: Make a static property in the Beverage class that can only be accessed from inside the class called address which has the value "Melkmarkt 9, 2000 Antwerpen".
TODO: Print the address without creating a new instant of the beverage class 2 times in two different ways.

Use typehinting everywhere!
*/

class Bevrage
{

    private string $color;
    private float $price;
    private string $temperature;

    const BARNAME = 'Het Vervolg' ;

    public static $adress = 'Melkmarkt 9, 2000 Antwerpen';

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

    public function getNameBar(){
        return self::BARNAME;
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
    public function getBeerNameBar(){
        return parent::BARNAME;
    }
    public function getAdress(){
        return parent::$adress;
    }
}

echo Bevrage::BARNAME;
$duvel = new Beer('blond', 3.5,'Duvel',8.5);
echo'<br>';
echo $duvel->getNameBar();
echo'<br>';
echo $duvel->getBeerNameBar();
echo'<br>';
echo Bevrage::$adress;
echo'<br>';
echo $duvel->getAdress();

?>