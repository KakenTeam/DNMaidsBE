<?php

use Illuminate\Database\Seeder;

class GroupGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per =\App\Models\Permission::whereIn('id', [5,7,8,9,10,11])->get();
        \App\Models\Group::find(3)->permissions()->saveMany($per);
    }
}
