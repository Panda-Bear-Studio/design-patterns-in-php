<?php

// only one instance of the singleton class can be created or is alive at any one time.

namespace singletonPattern;

class CakeMachine
{
    private static $instance = null;

    private function __construct() {
    }

    public static function startCakeMachine() {
        if (null === CakeMachine::$instance) {
            CakeMachine::$instance = new CakeMachine();
            echo "starting cake machine!" . PHP_EOL;
        } else {
            echo "sorry, cake machine is in use!" . PHP_EOL;
        }
        return CakeMachine::$instance;
    }

    public function stopCakeMachine() {
        self::$instance = null;
        echo "cake machine has stopped" . PHP_EOL;
    }
}

class Baker
{
    private $cakeMachine;
    private $hasStarted = false;

    function startCakeMachine() {
        $this->cakeMachine = CakeMachine::startCakeMachine();
        $this->hasStarted = true;
    }

    function stopCakeMachine() {
        $this->cakeMachine->stopCakeMachine();
        $this->hasStarted = false;
    }

    public function makeCake($type) {
        if($this->hasStarted) {
            echo "making $type :)" . PHP_EOL;
        } else {
            echo "please start the cake machine first!" . PHP_EOL;
        }
    }
}

$bakerTom = new Baker();
$bakerTom->startCakeMachine();
$bakerTom->makeCake("cheese cake");

$bakerEmma = new Baker();
$bakerEmma->startCakeMachine();
$bakerEmma->stopCakeMachine();
$bakerEmma->startCakeMachine();
$bakerEmma->makeCake("pumpkin cake");