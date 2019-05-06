<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $groups = ['Admin', 'Users Manage', 'Groups Manage', 'Contracts Manage', 'Employees Contracts Manage'];
        foreach ($groups as $group) {
            \Illuminate\Support\Facades\DB::table('groups')->insert([
                'group_name' => $group,
                'created_at' => \Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
//        $per = \App\Models\Permission::all();
//        \App\Models\Group::all()->each(function ($group) use ($per) {
//            $group->permissions()->saveMany($per->random(1)->values());
//        });
    }
}
