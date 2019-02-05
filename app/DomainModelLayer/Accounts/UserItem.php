<?php
namespace App\DomainModelLayer\Accounts;

use Analogue\ORM\Entity;
use Analogue\ORM\EntityCollection;
use App\DomainModelLayer\Accounts\User;
use App\DomainModelLayer\Items\Item;

class UserItem extends Entity
{

    public function __construct(User $user,Item $item)
    {
        $this->user = $user;
        $this->item = $item;
    }

    public function getUser(){
        return $this->user;
    }

    public function getItem(){
        return $this->item;
    }

    public function setUser(User $user){
        return $this->user = $user;
    }

    public function setItem(Item $item){
        return $this->item = $item;
    }



}