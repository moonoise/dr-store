<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articles;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5,10),true)),
        'body' => $faker->paragraphs(rand(3,7),true),
        'view_count' => rand(0,100),
        'user_id' => App\User::pluck('id')->random(),
        'categories_id' => App\Categories::pluck('id')->random()
    ];
});