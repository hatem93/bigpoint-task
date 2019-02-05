<?php

namespace App\DomainModelLayer\Accounts\Repositories;
use App\DomainModelLayer\Accounts\UserItem;

interface IAccountMainRepository
{
	public function getUserByUsername($username);
	public function login($credentials);
	public function getUserById($userId);
	public function storeUserItem(UserItem $userItem);
	public function checkIfItemExistInBasket($userId,$itemId);
	public function getNonUserItems($userId);
}