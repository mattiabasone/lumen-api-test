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

function getUserIdList(): array
{
    global $userIdList;
    if (empty($userIdList)) {
        $userIdList = App\Models\User::query()
            ->select(['id'])
            ->where('role', '=', 'user')
            ->pluck('id')
            ->toArray();
    }
    return $userIdList;
}

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

$factory->define(App\Models\Wishlist::class, static function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomElement(getUserIdList()),
        'name' => $faker->colorName,
    ];
});
