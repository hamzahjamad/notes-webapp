<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function($u){
        	//text
        	for ($i=0; $i < 10; $i++) { 
        		$u->notes()->save(factory(App\Note::class)->make());
        	}

        	$faker = Faker::create();
        	//list
        	for ($i=0; $i < 3; $i++) { 
        		$u->notes()->save(
        			factory(
        				App\Note::class)->make([
        					'type'=>'list',
        					'content'=> json_encode([
        						$faker->paragraph(),
        						$faker->paragraph(),
        						$faker->paragraph()
        					]),
        				]
        			)
        		);
        	}
        });
    }
}
