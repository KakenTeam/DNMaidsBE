<?php

use Illuminate\Database\Seeder;

class FeeIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $value =
        [
            [
                'name' => 'Giá Gốc',
                'code' => 'base',
                'value' => '87000'
            ],
            [
                'name' => 'Giảm Giá 3 Giờ',
                'code' => 'threehours',
                'value' => '0.1'
            ],
            [
                'name' => 'Giảm Giá Trên 3 Giờ',
                'code' => 'overthree',
                'value' => '0.2'
            ],
            [
                'name' => 'Giảm Giá Cuối Tuần',
                'code' => 'weekend',
                'value' => '-0.1'
            ],
        ];
        foreach ($value as $item) {
            $index = new \App\Models\FeeIndex();
            $index->fill($item);
           $index->save();
        }
    }
}
