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
        $skill = \App\Models\Skill::all();
        factory(\App\Models\User::class, 30)->create()->each(function ($user) use ($skill) {
            $user->role= 1;
            $user->save();
            $user->empContract()->save(factory(\App\Models\EmployeeContract::class)->make(['emp_id'=> null]));
            $user->skills()->attach($skill->random(rand(1,7))->values());
        });
    }
}
