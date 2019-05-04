<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Sửa Điện', 'Sửa Nước', 'Vệ Sinh', 'Chăm Trẻ'];
        $code = ['dien', 'nuoc', 'vesinh', 'tre'];
        foreach ($name as $index => $value) {
            \Illuminate\Support\Facades\DB::table('skills')->insert([
                'name' => $value,
                'code' => $code[$index],
        ]);
        }

    }
}
