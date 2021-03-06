<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
	$title = $faker->sentence();
	$slug = str_slug($title, '-');
    return [
        'title' => $title, 
        'slug'=> $slug, 
        'content' => json_encode([$faker->paragraph()]), 
        'type' => 'text',
    ];
});
