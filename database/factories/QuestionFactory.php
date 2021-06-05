<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Question::class, function (Faker $faker) {

    $options = ['option_a', 'option_b', 'option_c', 'option_d'];

    return [
        'question'  =>  $faker->paragraph(1),
        'option_a'  =>  $faker->paragraph(1),
        'option_b'  =>  $faker->paragraph(1),
        'option_c'  =>  $faker->paragraph(1),
        'option_d'  =>  $faker->paragraph(1),
        'correct_answer'    =>  Arr::random($options),
        'created_at' =>  now(),
        'updated_at' =>  now(),
    ];
});
