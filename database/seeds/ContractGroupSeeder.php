<?php

use Illuminate\Database\Seeder;

class ContractGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $per =\App\Models\Permission::whereIn('id', [5,6,12,13,14])->get();
        \App\Models\Group::find(4)->permissions()->saveMany($per);
    }
}
