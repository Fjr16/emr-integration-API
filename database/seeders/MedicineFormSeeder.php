<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'ALKES'],
            ['id' => 2, 'name' => 'BENANG PICIS'],
            ['id' => 3, 'name' => 'BENANG ROL'],
            ['id' => 4, 'name' => 'BMHP'],
            ['id' => 5, 'name' => 'BMHP LABOR KLINIS'],
            ['id' => 6, 'name' => 'BMHP LABOR PA'],
            ['id' => 7, 'name' => 'CHEMO'],
            ['id' => 8, 'name' => 'CHRONIS'],
            ['id' => 9, 'name' => 'CREAM'],
            ['id' => 10, 'name' => 'DROP'],
            ['id' => 11, 'name' => 'GEL'],
            ['id' => 12, 'name' => 'IMPLANT'],
            ['id' => 13, 'name' => 'INFUS'],
            ['id' => 14, 'name' => 'INJEKSI'],
            ['id' => 15, 'name' => 'LARUTAN'],
            ['id' => 16, 'name' => 'NONE'],
            ['id' => 17, 'name' => 'PACTH'],
            ['id' => 18, 'name' => 'serbuk'],
            ['id' => 19, 'name' => 'SIRUP'],
            ['id' => 20, 'name' => 'SPRAY'],
            ['id' => 21, 'name' => 'SUPPOS'],
            ['id' => 22, 'name' => 'SUSU'],
            ['id' => 23, 'name' => 'TABLET'],
        ];

        foreach ($data as $item) {
            DB::table('medicine_forms')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
