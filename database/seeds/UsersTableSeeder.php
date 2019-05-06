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
        factory(\App\Models\User::class, 100)->create();
        $groups = \App\Models\Group::where('id','!=','1')->get();
        \App\Models\User::all()->each(function ($user) use ($groups) {
            if ($user->role == 0) {
                $user->groups()->saveMany($groups->random(1)->values());
            }
        });
    }
}
