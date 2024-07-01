<?php

declare(strict_types=1);

$basket = [];
$total = 0;
$totalTaxe = 0;

$basket['Banana'] = [6, 1, 6];
$basket['Apple'] = [3, 1.5, 6];
$basket['Bottles_wine'] = [2, 10, 21];

foreach ($basket as $key => $value) {
    $addition = $value[0] * $value[1];
    $additionTaxe =  $addition + (($addition / 100) * $value[2]);
    $total += $addition;
    $totalTaxe +=  $additionTaxe;
}
echo $total;
echo '<br>';
echo $totalTaxe;


class Item
{

    private string $ItemName;
    private float $quantity;
    private float $price;
    private float $taxe;

    public function __construct(string $ItemName, float $quantity, float $price, float $taxe = 0.21)
    {
        $this->ItemName = $ItemName;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->taxe = $taxe;
    }

    private function getTotal()
    {

        return $this->quantity * $this->price;
    }

    private function getTotalTaxe()
    {
        return $this->getTotal() * $this->taxe;
    }
    public function getTotalWithTaxe()
    {
        return $this->getTotal() + $this->getTotalTaxe();
    }

}

$Item1 =  new Item('banana',6,1,0.06);
$Item2 =  new Item('Apple',3,1.5,0.06);
$Item3 =  new Item('Bottles_wine',2,10);

$total = $Item1->getTotalWithTaxe() + $Item2->getTotalWithTaxe() + $Item3->getTotalWithTaxe();
echo "<br>{$total}";

?>