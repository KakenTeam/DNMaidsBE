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
    }
}
