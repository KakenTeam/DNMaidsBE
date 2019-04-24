<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 50)->create();
        $groups = \App\Models\Group::all();
        \App\Models\User::all()->each(function ($user) use ($groups) {
            $user->groups()->saveMany($groups->random(1)->values());
        });
    }
}
