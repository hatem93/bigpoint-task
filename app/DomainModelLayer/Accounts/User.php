<?php

namespace App\DomainModelLayer\Accounts;

use Analogue\ORM\Entity;
use Analogue\ORM\EntityCollection;
use App\ApplicationLayer\Accounts\UserItem;
use Illuminate\Support\Facades\Event;

class User extends Entity
{
	public function __construct($userDto)
    {
    	$this->firstname = $userDto->firstname;
        $this->lastname = $userDto->lastname;
        $this->username = $userDto->username;
        $this->password = bcrypt($userDto->password);
        $this->address = $userDto->address;	
    }

    public function getUsername(){
    	return $this->username;
    }

    public function setUsername($username){
    	$this->username = $username;
    }

    public function getFirstname(){
    	return $this->firstname;
    }

    public function setFirstname($firstname){
    	$this->firstname = $firstname;
    }

    public function getLastname(){
    	return $this->lastname;
    }

    public function setLastname($lastname){
    	$this->lastname = $lastname;
    }

    public function getAddress(){
    	return $this->address;
    }

    public function setAddress($address){
    	$this->address = $address;
    }

    public function setPassword($password){
    	$this->password = bcrypt($password);
    }

    public function getUserItems()
    {
        return $this->userItems;
    }

    public function addUserItem(UserItem $item)
    {
        return $this->userItems->push($item);
    }

    public function removeUserItem(Role $item)
    {
        return $this->userItems->remove($item);
    }

}