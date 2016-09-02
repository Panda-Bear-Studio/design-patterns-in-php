<?php

// Provide a unified interface to a set of interfaces in a subsystem.
// Facade defines a higher-level interface that makes the subsystem easier to use.

namespace facadePattern;

class BuyCake
{
    public $type;
    public $amount;
    private $price;

    public function __construct($type, $amount)
    {
        $this->type = $type;
        $this->amount = $amount;
    }

    private function bakeCake() {
        echo "making $this->amount $this->type..." . PHP_EOL;
    }

    private function applyIcing() {
        echo "covering cake with icing..." . PHP_EOL;
    }

    private function applyDiscount($price) {
        return $price * 0.8;
    }

    private function getPrice() {
        $this->price = $this->applyDiscount($this->amount) * 10;
    }

    private function placeOrder() {
        echo "$this->type is ready! your total is $this->price" . PHP_EOL;
    }

    public function generateOrder() {
        $this->bakeCake();
        $this->applyIcing();
        $this->getPrice();
        $this->placeOrder();
    }
}

$buyCheeseCake = new BuyCake("cheese cake", 3);
$buyCheeseCake->generateOrder();

$buyCarrotCake = new BuyCake("carrot cake", 3);
$buyCarrotCake->generateOrder();