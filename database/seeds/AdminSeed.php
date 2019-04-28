<?php

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'nhat',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $admin = \App\Models\User::whereEmail('admin@gmail.com')->first();

        \Illuminate\Support\Facades\DB::table('group_user')->insert([
            'user_id' => $admin->id,
            'group_id' => 1,
        ]);

        \Illuminate\Support\Facades\DB::table('group_permission')->insert([
            'group_id' => 1,
            'permission_id' =>1,
        ]);
        factory(\App\Models\Contract::class, 3)->create()->each(function ( $contract) use ($admin) {
            $contract->customer_id = $admin->id;
            $contract->save();
            $contract->schedule()->saveMany(factory(\App\Models\ContractSchedule::class, 2)->make(['contract_id' => NULL]));
        });
    }
}
