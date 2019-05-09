<?php

use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\User::all() as $user) {
            \Illuminate\Support\Facades\DB::table('feedback')->insert([
                'user_id' => $user->id,
                'contract_id' => \App\Models\Contract::all()->random()->id,
                'feedback' => str_random(10),
                'status' => rand(0, 1) ? 'unresolved' : 'resolved',
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ]);
        }

    }
}
