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
        $name = [
            'Dọn Dẹp Vệ Sinh',
            'Chăm Sóc Cây Cảnh',
            'Chăm Sóc Trẻ Em',
            'Chăm Sóc Người Già',
            'Chăm Sóc Thú Cưng',
            'Nấu Ăn',
            'Đi Chợ',
        ];

        foreach ($name as $value) {
            \Illuminate\Support\Facades\DB::table('skills')->insert([
                'name' => $value,
            ]);
        }

    }
}
