<?php

namespace App\DomainModelLayer\Accounts;

use Analogue\ORM\EntityMap;
use App\DomainModelLayer\Accounts\User;
use App\DomainModelLayer\Items\Item;

class UserItemMap extends EntityMap
{

    protected $table = 'user_items';
    public $timestamps = true;


    public function user(UserItem $userItem)
    {
        return $this->belongsTo($userItem, User::class, 'user_id', 'id');
    }

    public function item(UserItem $userItem)
    {
        return $this->belongsTo($userItem, Item::class, 'item_id', 'id');
    }
}