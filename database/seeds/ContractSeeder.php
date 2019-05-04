<?php

use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill = \App\Models\Skill::all();
        factory(\App\Models\Contract::class, 100)->create()->each(function ($contract) use ($skill) {
            $contract->schedule()->saveMany(factory(\App\Models\ContractSchedule::class, 2)->make(['contract_id' => NULL]));
            $contract->skills()->attach($skill->random(rand(1, 3))->values());
        });
    }
}
