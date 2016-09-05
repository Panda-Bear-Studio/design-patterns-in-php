<?php

// allows behavior to be added to an individual object, either statically or dynamically,
// without affecting the behavior of other objects from the same class.

namespace decoratorPattern;

interface BasicCake
{
    public function makeCake();
    public function deliverCake();
}

class Cake implements BasicCake
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function makeCake()
    {
        echo "making $this->type..." . PHP_EOL;
    }

    public function deliverCake()
    {
        echo "your $this->type is ready!" . PHP_EOL;
    }
}

abstract class CakeDecorator
{
    protected $cake;

    public function __construct($cake)
    {
        $this->cake = $cake;
    }

    abstract function makeCake();
}

class CakeWithCherry extends CakeDecorator
{
    public function makeCake()
    {
        $this->cake->makeCake();
        echo "add cherry..." . PHP_EOL;
    }

    public function deliverCake()
    {
        $this->cake->deliverCake();
    }
}

class CakeWithHoney extends CakeDecorator
{
    public function makeCake()
    {
        $this->cake->makeCake();
        echo "add honey..." . PHP_EOL;
    }

    public function deliverCake()
    {
        $this->cake->deliverCake();
    }
}

$cheeseCake = new Cake("cheese cake");
$cakeWithCherry = new CakeWithCherry($cheeseCake);
$cakeWithHoney = new CakeWithHoney($cakeWithCherry);
$cakeWithHoney->makeCake();
$cakeWithHoney->deliverCake();