<?php

declare(strict_types=1);

class Item
{

    private string $ItemName;
    private float $quantity;
    private float $price;
    private float $taxe;
    private float $reduction;

    public function __construct(string $ItemName, float $quantity, float $price, float $taxe = 0.21, float $reduction = 0)
    {
        $this->ItemName = $ItemName;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->taxe = $taxe;
        $this->reduction = $reduction;
    }
    // calcule le totale apr item
    private function getTotal()
    {
        return $this->quantity * $this->price;
    }
    // calcule la reduction si item en a une 
    private function getTotalWithReduction()
    {
        return $this->getTotal() * $this->reduction;
    }
    // calcule la taxe du total sans reduction
    private function getTotalTaxe()
    {
        return $this->getTotalWithReduction() * $this->taxe;
    }
    // addition total avec reduction + taxe
    public function getTotalWithTaxe()
    {
        return ($this->getTotal() - $this->getTotalWithReduction()) + $this->getTotalTaxe();
    }
}

$item1 =  new Item('banana', 6, 1, 0.06, 0.5);
$item2 =  new Item('Apple', 3, 1.5, 0.06, 0.5);
$item3 =  new Item('Bottles_wine', 2, 10);

$total = $item1->getTotalWithTaxe() + $item2->getTotalWithTaxe() + $item3->getTotalWithTaxe();
echo "<br>".number_format($total, 2, '.', '');


