<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'id' => 1,
                'name' => 'Umum',
                'margin' => 0,
            ],
            [
                'id' => 18,
                'name' => 'BPJS',
                'margin' => 0,
            ],
            [
                'id' => 19,
                'name' => 'PT Semen Padang',
                'margin' => 5,
            ],
            [
                'id' => 21,
                'name' => 'Padang Eye Center',
                'margin' => 5,
            ],
            [
                'id' => 22,
                'name' => 'PT. PLTD PLN',
                'margin' => 10,
            ],
            [
                'id' => 23,
                'name' => 'PDAM SUMBAR',
                'margin' => 10,
            ],
        ];
        foreach ($arr as $item) {
            DB::table('patient_categories')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'margin' => $item['margin'],
            ]);
        }
    }
}
