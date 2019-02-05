<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserItemTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    


    public function testTokenRequireForAddItemSeeBasket()
    {
    	$responseAddItem = $this->call('POST', '/user/add');
       	$responseUserItem = $this->call('GET', '/user/items');
       	$this->assertEquals(400, $responseAddItem->status());
       	$this->assertEquals(400, $responseUserItem->status());
    }

    public function testAddItemToBasket(){
    	$faker = Faker\Factory::create();
    	\Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
        $username = $faker->userName;
        $password = $faker->password;
        $firstname = $faker->firstName;
        $lastname = $faker->lastName;
        $address = $faker->address;
        $email = $faker->email;
        $userId = DB::table('users')->insertGetId([
       		'username'=> $username,
       		'password'=> bcrypt($password),
       		'address'=>$address,
       		'firstname'=>$firstname,
       		'lastname'=>$lastname,
       		'email'=>$email
       	]);

       	$itemId = DB::table('items')->insertGetId([
	        'name' => $faker->productName,
	        'description' => $faker->text,
	        'price'=> rand(10,100)
	    ]);

       	$token = JWTAuth::attempt(['username'=>$username,'password'=>$password]);
       
       	$response = $this->call('POST', '/user/add?token='.$token,[
       		'itemId'=>$itemId
       	]);
     
       	$this->assertEquals(200, $response->status());

       	$this->seeInDatabase('user_items', [
        	'item_id' => $itemId,
        	'user_id'=> $userId
    	]);

    }
}
