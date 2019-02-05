<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class UserTest extends TestCase
{
	use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginSuccess()
    {

        //create user
        $faker = Faker\Factory::create();

        $username = $faker->userName;
        $password = $faker->password;
        $firstname = $faker->firstName;
        $lastname = $faker->lastName;
        $address = $faker->address;
        $email = $faker->email;
        DB::table('users')->insert([
       		'username'=> $username,
       		'password'=> bcrypt($password),
       		'address'=>$address,
       		'firstname'=>$firstname,
       		'lastname'=>$lastname,
       		'email'=>$email
       	]);

       	$response = $this->call('POST', '/login',[
       		'username'=>$username,
       		'password'=>$password
       	]);
       	$this->assertEquals(200, $response->status());

    }
}
