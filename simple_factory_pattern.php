<?php

// allows interfaces for creating objects without exposing the object creation logic to the client
// some says that simple factory pattern is not really a design pattern

// TODO factory method pattern
// TODO abstract factory pattern

namespace simpleFactoryPattern;

abstract class BasicCake
{
    private $size;
    protected $type;
    protected $topping;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function deliverCake()
    {
        echo "Your $this->size inches $this->type is ready!" . PHP_EOL;
    }
}

class BananaCake extends BasicCake
{
    protected $type = "banana cake";
    protected $topping = "banana";
}

class AppleCake extends BasicCake
{
    protected $type = "apple cake";
    protected $topping = "apple";
}

class CakeFactory
{
    public static function makeCake($cakeType, $size)
    {
        $cake = null;
        switch ($cakeType) {
            case "banana":
                $cake = new BananaCake($size);
                break;
            case "apple":
                $cake = new AppleCake($size);
                break;
            default:
                $cake = new AppleCake($size);
                break;
        }
        return $cake;
    }
}


$appleCake = CakeFactory::makeCake("apple", 6);
$appleCake->deliverCake();

$bananaCake = CakeFactory::makeCake("banana", 8);
$bananaCake->deliverCake();
