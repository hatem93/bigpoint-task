<?php

namespace App\DomainModelLayer\Items\Repositories;

interface IItemMainRepository
{
	public function getItemById($itemId);
}