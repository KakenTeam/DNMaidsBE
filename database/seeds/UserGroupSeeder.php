<?php

use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per =\App\Models\Permission::whereIn('id', [2,3,4,5,6])->get();
        \App\Models\Group::find(2)->permissions()->saveMany($per);
    }
}
