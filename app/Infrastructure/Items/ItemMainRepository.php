<?php

namespace App\Infrastructure\Items;
use App\DomainModelLayer\Items\Repositories\IItemMainRepository;
use Analogue;

class ItemMainRepository implements IItemMainRepository
{
		public function getItemById($itemId){
			$itemRepository = new itemRepository;
        	return $itemRepository->getItemById($itemId);
		}
}