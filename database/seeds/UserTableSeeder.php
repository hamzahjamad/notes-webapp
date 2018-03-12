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
            factory(App\Note::class, 10)->make()->each(function($n) use ($u) {
                  $u->notes()->save($n);
                  $n->contents()->save(factory(App\Content::class)->make());  
            });


            //list    
            factory(App\Note::class, 10)->make(['type'=>'list'])->each(function($n) use ($u) {
                  $u->notes()->save($n);

                  factory(App\Content::class, 20)->make()->each(function($c) use ($n){
                         $n->contents()->save($c);  
                  });
                 
            });
        });
    }
}
