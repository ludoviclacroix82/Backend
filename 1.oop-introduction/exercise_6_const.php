<?php

declare(strict_types=1);

/* EXERCISE 6

Copy the classes of exercise 2.

TODO: Change the properties to private.
TODO: Make a const barname with the value 'Het Vervolg'.
TODO: Print the constant on the screen.
TODO: Create a function in beverage and use the constant.
TODO: Do the same in the beer class.
TODO: Print the output of these functions on the screen.
TODO: Make sure that every print is on a new line.

Use typehinting everywhere!
*/

class Bevrage
{

    private string $color;
    private float $price;
    private string $temperature;

    const BARNAME = 'Het Vervolg' ;

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
        return self::BARNAME;
    }
}

echo Bevrage::BARNAME;
$duvel = new Beer('blond', 3.5,'Duvel',8.5);
echo'<br>';
echo $duvel->getNameBar();
echo'<br>';
echo $duvel->getBeerNameBar()
?>