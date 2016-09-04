<?php

// The command pattern is a behavioral design pattern in which
// an object is used to represent and encapsulate all the information needed to call a method at a later time.

namespace commandPattern;

class CakeControl
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function makeCake() {
        echo "making $this->type..." . PHP_EOL;
    }

    public function destroyCake() {
        echo "don't like $this->type? OK, I'll throw it :(" . PHP_EOL;
    }
}

interface Command
{
    public function execute();
}

class MakeCakeCommand implements Command
{
    private $cakeControl;

    public function __construct($cakeControl)
    {
        $this->cakeControl = $cakeControl;
    }

    public function execute()
    {
        $this->cakeControl->makeCake();
    }
}

class DestroyCakeCommand implements Command
{
    private $cakeControl;

    public function __construct($cakeControl)
    {
        $this->cakeControl = $cakeControl;
    }

    public function execute()
    {
        $this->cakeControl->destroyCake();
    }
}

$cakeControl = new CakeControl("cheese cake");
$makeCakeCommand = new MakeCakeCommand($cakeControl);
$makeCakeCommand->execute();
$destroyCakeCommand = new DestroyCakeCommand($cakeControl);
$destroyCakeCommand->execute();