<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        DB::table('users')->insert([
            'username' => 'patrick',
            'firstname' =>'Patrick',
            'lastname'=>'Leitz',
            'email' => 'p.leitz@bigpoint.net',
            'password' => bcrypt('123456'),
            'address'=>$faker->address
        ]);

        DB::table('users')->insert([
            'username' => 'alex',
            'firstname' =>'Alex',
            'email' => 'alex@bigpoint.net',
            'password' => bcrypt('123456'),
            'address' => $faker->address
        ]);
    }
}
