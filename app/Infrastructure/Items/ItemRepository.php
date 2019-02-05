<?php

namespace App\Infrastructure\Items;

use Analogue;
use App\DomainModelLayer\Items\Item;
use App\DomainModelLayer\Items\ItemMap;

class ItemRepository
{
	public function getItemById($itemId){
		$itemMapper= Analogue::mapper(Item::class,ItemMap::class);
        $item = $itemMapper->query()->where('id', $itemId)->first();
        return $item;
	}
}