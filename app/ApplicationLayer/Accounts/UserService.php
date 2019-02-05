<?php

namespace App\ApplicationLayer\Accounts;

use App\ApplicationLayer\Accounts\Interfaces\IAccountMainService;
use App\DomainModelLayer\Accounts\Repositories\IAccountMainRepository;
use App\DomainModelLayer\Items\Repositories\IItemMainRepository;
use App\Helpers\ResponseObject;
use App\Helpers\Mapper;
use App\Exceptions\BadRequestException;
use App\ApplicationLayer\Accounts\Dtos\UserLoginDto;
use App\ApplicationLayer\Accounts\Dtos\UserItemDto;
use App\DomainModelLayer\Accounts\UserItem;

class UserService
{

    private $accountRepository;
    private $itemRepository;


    public function __construct(IAccountMainRepository $accountRepository, IItemMainRepository $itemRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->itemRepository = $itemRepository;
    }

    public function login(UserLoginDto $userloginDto)
    {
        
        $response = new ResponseObject();
        $response->token = $this->accountRepository->login($userloginDto);
        $response->user = $this->accountRepository->getUserByUsername($userloginDto->username);
        $response->status_code = 200;
        return $response;
    }

    public function addItem($userId,$itemId){
        $user = $this->accountRepository->getUserById($userId);
        if($user == null)
            throw new BadRequestException('there is no user with this id');

        $item = $this->itemRepository->getItemById($itemId);
        if($item == null)
            throw new BadRequestException('there is no item with this id');
        if($this->accountRepository->checkIfItemExistInBasket($userId,$itemId))
            throw new BadRequestException('this item is already in basket');

        $userItem = new UserItem($user,$item);
        $this->accountRepository->storeUserItem($userItem);

        return "item added successfully";
    }

    public function getUserItems($userId){
        $user = $this->accountRepository->getUserById($userId);
        if($user == null)
            throw new BadRequestException('there is no user with this id');

        $userItems = $user->getUserItems();
        $items = [];
        foreach ($userItems as $key => $value) {
            array_push($items, $value->getItem());
        }

        return Mapper::MapEntityCollection(UserItemDto::class,$items);
    }

    public function getNonUserItems($userId){
        $user = $this->accountRepository->getUserById($userId);
        if($user == null)
            throw new BadRequestException('there is no user with this id');

        $nonUserItems = $this->accountRepository->getNonUserItems($userId);

        return Mapper::MapEntityCollection(UserItemDto::class,$nonUserItems);
    }

}