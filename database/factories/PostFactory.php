<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $image = "Post_Image_" . rand(1, 5) . ".jpg";

    return [
        'title' => $faker->sentence(rand(8, 12)),
        'slug' => $faker->slug(),
        'excerpt' => $faker->text(rand(250, 300)),
        'body' => $faker->paragraphs(rand(10, 15), true),
        'image' => rand(0, 1) == 1 ? $image : null,
        'created_at' => $faker->dateTimeBetween('-1 months'),
        'updated_at' => $faker->dateTimeBetween('-5 days'),
    ];
});
