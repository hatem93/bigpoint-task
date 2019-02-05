<?php

namespace App\ApplicationLayer\Accounts\Interfaces;

use App\ApplicationLayer\Accounts\Dtos\UserLoginDto;
interface IAccountMainService
{
	public function login(UserLoginDto $userloginDto);
	public function addItem($userId,$itemId);
	public function getUserItems($userId);
	public function getNonUserItems($userId);
}


