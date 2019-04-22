<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Contract::class, function (Faker $faker) {
    return [
        "customer_id" => \App\Models\User::all()->random()->id,
        "helper_id" =>  \App\Models\User::all()->random()->id,
        "contract_creator_id" =>  \App\Models\User::all()->random()->user_id,
        "address" => str_random(10),
	    "start_date" => \Illuminate\Support\Carbon::now()->subDays(random_int(5,10)),
	    "end_date"=> \Illuminate\Support\Carbon::now()->subDays(random_int(0,5)),
	    "service_type" => random_int(0,1),
        "fee" => random_int(200000, 500000),
    ];
});
