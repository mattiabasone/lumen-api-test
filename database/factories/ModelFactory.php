<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\User::class, static function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'password' => Hash::make('password'),
        'role' => $faker->randomElement(['user', 'admin'])
    ];
});

$factory->define(App\Models\Product::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'price' => $faker->randomNumber(2),
    ];
});
