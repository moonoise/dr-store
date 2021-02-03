<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Uploads;
use Faker\Generator as Faker;

$factory->define(Uploads::class, function (Faker $faker) {
    // $pathanme =  storage_path('app/public/files');
    $pathanme =  'app/public/files';
    // $filename = $faker->image(null,640,480,'cats',false);
    $filename = $faker->firstName();
    return [
        'path' => $pathanme,
        'file_name' => $filename.".png",
        'source_name' => $filename.".png",
        'download_count' => rand(0,100),
        'articles_id' => App\Articles::pluck('id')->random()
    ];
});