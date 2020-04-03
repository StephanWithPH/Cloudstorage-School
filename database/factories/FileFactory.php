<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\File;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(File::class, function (Faker $faker) {
    $extension = $faker->fileExtension();
    $deleted = $faker->boolean;
    $randomdate = $faker->dateTimeBetween('-500 days', '+0 days');
    return [
        'name' => $faker->word(). '.' . $extension,
        'path' => '400032102@st.roc.a12.nl/5zLP6UHMKl8VkSf7DGR0OvjkdATbZVO4JPCNe6sq.jpeg',
        'extension' => $extension,
        'deleted_at' => $deleted ? $faker->dateTime : null,
        'deleted' => $deleted,
        'created_at' => $randomdate,
        'updated_at' => $randomdate,

    ];
});
