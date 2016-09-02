<?php

// Convert the interface of a class into another interface clients expect.
// Adapter lets classes work together that couldn't otherwise because of incompatible interfaces.

namespace adapterPattern;

class CheeseCake
{
    private $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function bakeCake() {
        echo "your $this->size inches cheese cake is ready!" . PHP_EOL;
    }
}

class CakeAdapter
{
    private $cake;

    public function __construct($cake)
    {
        $this->cake = $cake;
    }

    public function makeCake() {
        $this->cake->bakeCake();
    }
}

$cheeseCake = new CakeAdapter(new CheeseCake(8));
$cheeseCake->makeCake();