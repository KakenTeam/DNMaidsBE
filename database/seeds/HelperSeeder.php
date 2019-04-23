<?php

use Illuminate\Database\Seeder;

class HelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 20)->create()->each(function ($user) {
            $user->role= 1;
            $user->save();
        });

    }
}
