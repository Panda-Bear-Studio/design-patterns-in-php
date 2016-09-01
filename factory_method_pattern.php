<?php

// Define an interface for creating an object, but let subclasses decide which class to instantiate.
// The "new" operator considered harmful.

abstract class BasicCake
{
    private $size;
    protected $type;
    protected $topping;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function makeCake()
    {
        echo "Your $this->size inches $this->type cake is ready!" . PHP_EOL;
    }
}

class CheeseCake extends BasicCake
{
    protected $type = "cheese cake";
    protected $topping = "cheese";
}

class ChocolateCake extends BasicCake
{
    protected $type = "chocolate cake";
    protected $topping = "chocolate";
}

class BananaCake extends BasicCake
{
    protected $type = "banana cake";
    protected $topping = "banana";
}

class CakeFactoryMethod
{
    public static function bake($cakeType, $size)
    {
        $cakeClass = ucfirst($cakeType) . "Cake";
        if(class_exists($cakeClass)) {
            return new $cakeClass($size);
        } else {
            throw new \Exception("Sorry, we don't know how to make this cake!" . PHP_EOL);
        }
    }
}

$cakeOrders = [
    [
        "cakeType" => "chocolate",
        "size" => 6
    ],
    [
        "cakeType" => "beer",
        "size" => 6
    ],
    [
        "cakeType" => "cheese",
        "size" => 4
    ],
    [
        "cakeType" => "banana",
        "size" => 10
    ]
];

foreach ($cakeOrders as $cakeOrder) {
    try {
        CakeFactoryMethod::bake($cakeOrder["cakeType"], $cakeOrder["size"])->makeCake();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}