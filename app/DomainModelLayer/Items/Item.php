<?php

namespace App\DomainModelLayer\Items;

use Analogue\ORM\Entity;
use Analogue\ORM\EntityCollection;

class Item extends Entity
{
	public function __construct($itemDto)
    {
    	$this->name = $itemDto->name;
        $this->description = $itemDto->description;
        $this->price = $itemDto->price;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
    	return $this->name;
    }

    public function setName($name){
    	$this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }
}