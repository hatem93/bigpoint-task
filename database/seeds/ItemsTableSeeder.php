<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
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
        \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
        for($i =0;$i<100;$i++){
        	DB::table('items')->insert([
	            'name' => $faker->productName,
	            'description' => $faker->text,
	            'price'=> rand(10,100)
	        ]);
        }
    }
}
