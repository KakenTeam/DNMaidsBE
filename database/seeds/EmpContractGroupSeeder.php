<?php

use Illuminate\Database\Seeder;

class EmpContractGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per =\App\Models\Permission::whereIn('id', [5,6,15,16,17,18,19])->get();
        \App\Models\Group::find(5)->permissions()->saveMany($per);
    }
}
