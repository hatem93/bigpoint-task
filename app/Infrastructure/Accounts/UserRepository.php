<?php

namespace App\Infrastructure\Accounts;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Exceptions\BadRequestException;
use App\Exceptions\UnauthorizedException;
use JWTFactory;
use JWTAuth;
use Analogue;
use App\DomainModelLayer\Accounts\User;
use App\DomainModelLayer\Accounts\UserMap;
use App\DomainModelLayer\Items\Item;
use App\DomainModelLayer\Accounts\UserItem;
use App\DomainModelLayer\Accounts\UserItemMap;
use App\DomainModelLayer\Items\ItemMap;
use DB;

class UserRepository extends Authenticatable
{
    protected $table = 'users';

    function login($credentials)
    {

        $login_credentials = ['username' => $credentials->username, 'password' => $credentials->password];
        try {
            if (! $token = JWTAuth::attempt($login_credentials)) {
                    throw new UnauthorizedException(trans('wrong credentials'));
            }
        } catch (JWTException $e) {
            throw new BadRequestException("could not create token");
        }
        return (compact('token'));
    }

    function getUserByUsername($username){
    	$userMapper= Analogue::mapper(User::class,UserMap::class);
        $user = $userMapper->query()->where('username', $username)->first();
        return $user;
    }

    public function getUserById($userId){
        $userMapper= Analogue::mapper(User::class,UserMap::class);
        $user = $userMapper->query()->where('id', $userId)->first();
        return $user;
    }
    public function storeUserItem(UserItem $userItem){
        $userItemMapper= Analogue::mapper(UserItem::class,UserItemMap::class);
        return $userItemMapper->store($userItem);
    }

    public function checkIfItemExistInBasket($userId,$itemId){
        $userItemMapper= Analogue::mapper(UserItem::class,UserItemMap::class);
        $userItem = $userItemMapper->query()->where('user_id', $userId)->where('item_id',$itemId)->first();
        return $userItem;
    }

    public function getNonUserItems($userId){
        $itemMapper = Analogue::mapper(Item::class,ItemMap::class);
        $items = $itemMapper->query()->whereNotIn('id',function($queryx) use ($userId){
                $queryx->select('item_id')->from('user_items')->where('user_id',$userId);
        })->orderBy('id')->get();
        return $items;
    }
}