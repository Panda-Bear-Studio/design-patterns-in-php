<?php

// It is allowed you to select an algorithms at runtime, it decouples the algorithms from where it is used
// It is to prevent you from having to touch the client each time a new behavior is added (cf. The Open/Closed Principle)

interface PriceCalculator
{
    public function calculate($amount);
}

class CherryCakePricingStrategy implements PriceCalculator
{
    public function calculate($amount) {
        return $amount * 20;
    }
}

class AppleCakePricingStrategy implements PriceCalculator
{
    public function calculate($amount) {
        return $amount * 30;
    }
}

class NullCakePricingStrategy implements PriceCalculator
{
    public function calculate($amount)
    {
        throw new Exception("Sorry, we don't have pricing for this cake" . PHP_EOL);
    }
}

class CakePricingStrategyContext
{
    public function select($type)
    {
        if ("apple cake" == $type) {
            return new AppleCakePricingStrategy;
        } elseif ("cherry cake" == $type) {
            return new CherryCakePricingStrategy;
        } else {
            return new NullCakePricingStrategy;
        }
    }
}

class Cake
{
    private $type;
    private $amount;
    private $context;
    private $price;

    public function __construct($type, $amount, CakePricingStrategyContext $context)
    {
        $this->type = $type;
        $this->amount = $amount;
        $this->context = $context;
    }

    private function calculatorCakePrice() {
        $this->price = $this->context->select($this->type)->calculate($this->amount);
    }

    public function deliver() {
        try {
            $this->calculatorCakePrice();
            echo "Delivering $this->amount $this->type, your total is $this->price". PHP_EOL;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

$appleCake = new Cake("apple cake", 2, new CakePricingStrategyContext);
$appleCake->deliver();

$meatCake = new Cake("meat cake", 10, new CakePricingStrategyContext);
$meatCake->deliver();

$cherryCake = new Cake("cherry cake", 10, new CakePricingStrategyContext);
$cherryCake->deliver();
