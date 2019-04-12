<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per = ['Admin',
            'create_user', 'update_user', 'delete_user', 'view_user', 'list_user'
            ];
        foreach ($per as $p) {
            \Illuminate\Support\Facades\DB::table('permissions')->insert([
                'permission' => $p,
            ]);
        }
    }
}
