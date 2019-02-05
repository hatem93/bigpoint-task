<?php

namespace App\ApplicationLayer\Accounts;

use App\ApplicationLayer\Accounts\Interfaces\IAccountMainService;
use App\ApplicationLayer\Accounts\UserService;
use App\DomainModelLayer\Accounts\Repositories\IAccountMainRepository;
use App\DomainModelLayer\Items\Repositories\IItemMainRepository;
use App\ApplicationLayer\Accounts\Dtos\UserLoginDto;


class AccountMainService implements IAccountMainService
{
	private $accountRepository;
    private $itemRepository;

    public function __construct(IAccountMainRepository $accountRepository,IItemMainRepository $itemRepository){
        $this->accountRepository = $accountRepository;
        $this->itemRepository = $itemRepository;
    }

    public function login(UserLoginDto $userLoginDto)
    {
        $userService = new UserService($this->accountRepository,$this->itemRepository);
        return $userService->login($userLoginDto);
    }

    public function addItem($userId,$itemId){
        $userService = new UserService($this->accountRepository,$this->itemRepository);
        return $userService->addItem($userId,$itemId);
    }

    public function getUserItems($userId){
        $userService = new UserService($this->accountRepository,$this->itemRepository);
        return $userService->getUserItems($userId);
    }

    public function getNonUserItems($userId){
        $userService = new UserService($this->accountRepository,$this->itemRepository);
        return $userService->getNonUserItems($userId);
    }
}