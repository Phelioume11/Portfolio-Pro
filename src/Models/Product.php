<?php

namespace App\Models;

class Product{
    private ?int $id;
    private ?string $name;
    private ?float $price;

    public function __construct(?int $id = null, ?string $name = null, ?float $price = null){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId():int{
        return $this->id;
    }

    public function setId(int $id):void{
        $this->id = $id;
    }

    public function getName():string{
        return $this->name;
    }

    public function setName(string $name):void{
        $this->name = $name;
    }

    public function getPrice():float{
        return $this->price;
    }

    public function setPrice(float $price):void{
        $this->price = $price;
    }
}