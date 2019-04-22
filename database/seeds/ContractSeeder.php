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
        factory(\App\Models\Contract::class, 100)->create()->each(function ( $contract) {
            $contract->schedule()->saveMany(factory(\App\Models\ContractSchedule::class, 2)->make(['contract_id' => NULL]));
        });
    }
}
