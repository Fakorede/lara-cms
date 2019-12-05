<?php

use App\Post;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $image = "Post_Image_" . rand(1, 5) . ".jpg";
    $i = $faker->numberBetween(1, 10);
    $date = Carbon::create(2019, 11, 28, 21)->addDays(1);
    $dates = clone($date);

    return [
        'title' => $faker->sentence(rand(8, 12)),
        'slug' => $faker->slug(),
        'excerpt' => $faker->text(rand(250, 300)),
        'body' => $faker->paragraphs(rand(10, 15), true),
        'image' => rand(0, 1) == 1 ? $image : null,
        'view_count' => rand(1, 10) * 10,
        'created_at' => $dates,
        'updated_at' => $dates,
        'published_at' => $i < 5 ? $dates : (rand(0, 1) == 0 ? null : $dates->addDays(4)),
    ];
});
