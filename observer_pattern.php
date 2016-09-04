<?php

// Define a one-to-many dependency between objects so that when one object changes state,
// all its dependents are notified and updated automatically

namespace observerPattern;

interface Observer
{
    public function update($cake);
}

interface Maker
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify($cake);
}

class CakeObserverOne implements Observer
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update($cake)
    {
        echo "behold, $this->name! now we have a new cake, $cake!" . PHP_EOL;
    }
}

class CakeObserverTwo implements Observer
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update($cake)
    {
        echo "behold, $this->name! now we have a new cake, $cake!" . PHP_EOL;
    }
}

class CakeMaker implements Maker
{
    private $observers = [];

    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer) {
        foreach($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
                echo "detach observer $observer->name" . PHP_EOL;
            }
        }
    }

    public function notify($cake) {
        foreach($this->observers as $observer) {
            $observer->update($cake);
        }
    }

    public function updateCake($cake) {
        $this->notify($cake);
    }
}

$cakeObserverOne = new CakeObserverOne("Tom");
$cakeObserverTwo = new CakeObserverTwo("Emma");
$cakeMaker = new CakeMaker();

$cakeMaker->attach($cakeObserverOne);
$cakeMaker->attach($cakeObserverTwo);
$cakeMaker->updateCake("cheese cake");
$cakeMaker->updateCake("chocolate cake");

$cakeMaker->detach($cakeObserverTwo);
$cakeMaker->updateCake("mango cake");
