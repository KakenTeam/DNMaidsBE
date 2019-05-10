<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'image' => $faker->randomElement([
            'avatars/1557465706download.jpg',
            'avatars/1557465713co-nen-cat-duoi-meo-hay-khong.jpg',
        ]),
        'remember_token' => Str::random(10),
        'address' => $faker->address,
        'phone' => $faker->unique()->numberBetween(1000000000, 1999999999),
        'birthday' => $faker->dateTimeBetween('-40 years', '-18 years'),
        'gender' => rand(0,1),
        'role' => rand(0,2),
        'created_at' => \Carbon\Carbon::now()->subDays(random_int(0,30)),
    ];
});
