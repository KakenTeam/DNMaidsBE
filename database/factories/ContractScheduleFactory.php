<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ContractSchedule::class, function (Faker $faker) {
    $time = $faker->time();
    return [
        'start_time' => $time,
        'end_time' => \Illuminate\Support\Carbon::createFromFormat('H:i:s' , $time)->addHours( $faker->numberBetween( 1, 4 )),
        'day_of_week' => random_int(0,6),
    ];
});
