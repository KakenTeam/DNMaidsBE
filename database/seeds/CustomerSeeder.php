<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 50)->create()->each(function ($user)  {
            $user->role= 2;
            $user->save();
        });
    }
}
