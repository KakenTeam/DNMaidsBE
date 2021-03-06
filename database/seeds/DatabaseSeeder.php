<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminSeed::class);
        $this->call(ContractSeeder::class);
        $this->call(FeeIndexSeeder::class);
        $this->call(HelperSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(UserGroupSeeder::class);
        $this->call(GroupGroupSeeder::class);
        $this->call(EmpContractGroupSeeder::class);
        $this->call(ContractGroupSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
