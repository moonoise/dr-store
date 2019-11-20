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
        'pathname' => $pathanme,
        'filename' => $filename,
        'oldname' => $filename,
        'newname' => $filename,
        'article_id' => App\Articles::pluck('id')->random()
    ];
});
