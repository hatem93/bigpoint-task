<?php

namespace App\Infrastructure\Accounts;

use Analogue;
use App\DomainModelLayer\Accounts\Repositories\IAccountMainRepository;
use App\DomainModelLayer\Accounts\UserItem;

class AccountMainRepository implements IAccountMainRepository
{
	public function getUserByUsername($username){
		$userRepository = new UserRepository;
        return $userRepository->getUserByUsername($username);
	}
	public function login($credentials){
		$userRepository = new UserRepository;
        return $userRepository->login($credentials);
	}
	public function getUserById($userId){
		$userRepository = new UserRepository;
        return $userRepository->getUserById($userId);
	}
	public function storeUserItem(UserItem $userItem){
		$userRepository = new UserRepository;
        return $userRepository->storeUserItem($userItem);
	}
	public function checkIfItemExistInBasket($userId,$itemId){
		$userRepository = new UserRepository;
        return $userRepository->checkIfItemExistInBasket($userId,$itemId);
	}
	public function getNonUserItems($userId){
		$userRepository = new UserRepository;
        return $userRepository->getNonUserItems($userId);
	}
}