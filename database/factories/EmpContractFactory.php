<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\EmployeeContract::class, function (Faker $faker) {
    $date = $faker->date();
    $duration = rand(3, 60);
    return [
        'valid_date' => $date,
        'duration' => $duration,
        'expired_date' => \Illuminate\Support\Carbon::createFromFormat('Y-m-d',$date)->addMonths($duration),
        'salary' => 500000*$faker->numberBetween(4,10),
        'image' =>json_encode(['https://static1.bestie.vn/Mlog/ImageContent/201707/1-20170724085644.jpg',
            'http://www.chomeo.com/wp-content/uploads/2016/04/huan-luyen-cho-khong-can-bay.jpg']) ,
    ];
});
