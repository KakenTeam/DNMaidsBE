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
        'image' => "https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjwtMGQ5OLhAhVQQLwKHUTcDeMQjRx6BAgBEAU&url=https%3A%2F%2Fbestie.vn%2F2017%2F07%2Fchu-meo-qua-dang-yeu-va-dep-khong-goc-chet-khien-ai-cung-muon-om-vao-long&psig=AOvVaw0VIM1ag5bn6zCEhNs7Xx9T&ust=1555990950343217",
        'remember_token' => Str::random(10),
    ];
});
