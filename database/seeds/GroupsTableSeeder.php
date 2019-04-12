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
    {   $groups = ['Admin', 'User Manage', 'New Group'];
        foreach ($groups as $group) {
            \Illuminate\Support\Facades\DB::table('groups')->insert([
                'group_name' => $group,
            ]);
        }
        $per = \App\Models\Permission::all();
        \App\Models\Group::all()->each(function ($group) use ($per) {
            $group->permissions()->saveMany($per->random(1)->values());
        });

    }
}
