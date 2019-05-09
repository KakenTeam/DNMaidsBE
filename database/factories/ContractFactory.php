<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Contract::class, function (Faker $faker) {
    $skills = \App\Models\Skill::pluck('id')->toArray();
    return [
        "customer_id" => \App\Models\User::all()->random()->id,
        "helper_id" =>  \App\Models\User::all()->random()->id,
        "last_editor_id" =>  $faker->randomElement([null,\App\Models\User::all()->random()->id]),
        "address" => str_random(10),
	    "start_date" => \Illuminate\Support\Carbon::now()->subDays(random_int(5,10)),
	    "end_date"=> \Illuminate\Support\Carbon::now()->subDays(random_int(0,5)),
	    "service_type" => random_int(0,1),
        "fee" => random_int(200000, 500000),
        "helper_gender" => rand(0,1),
        "status" => $faker->randomElement(['unverified', 'verified', 'assigned', 'paid','completed','canceled']),
        'created_at' => \Carbon\Carbon::now()->subDays(random_int(0,30)),
    ];
});
