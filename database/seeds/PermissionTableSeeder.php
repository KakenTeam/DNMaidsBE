<?php

use Illuminate\Database\Seeder;
use \App\Enum\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per = [Permission::$ADMIN,

            Permission::$CREATE_USER,
            Permission::$UPDATE_USER,
            Permission::$DELETE_USER,
            Permission::$LIST_USER,
            Permission::$VIEW_USER,

            Permission::$CREATE_GROUP,
            Permission::$UPDATE_GROUP,
            Permission::$DELETE_GROUP,
            Permission::$LIST_GROUP,
            Permission::$VIEW_GROUP,
            ];
        foreach ($per as $p) {
            \Illuminate\Support\Facades\DB::table('permissions')->insert([
                'permission' => $p,
            ]);
        }
    }
}
