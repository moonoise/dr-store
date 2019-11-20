<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Categories::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5,10),true)),
        'overview' => $faker->paragraphs(rand(3,7),true),
        'user_id' => App\User:: pluck('id')->random()
    ];
});
