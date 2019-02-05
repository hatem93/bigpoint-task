<?php

namespace App\DomainModelLayer\Accounts;

use Analogue\ORM\EntityMap;
use App\DomainModelLayer\Accounts\UserItem;

class UserMap extends EntityMap {

    protected $table = 'users';
    public $timestamps = false;

    public function userItems(User $user)
    {
        return $this->hasMany($user, UserItem::class, 'user_id', 'id');
    }

}