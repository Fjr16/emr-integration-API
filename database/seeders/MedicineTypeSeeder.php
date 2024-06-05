<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'GENERIK'],
            ['id' => 2, 'name' => 'NON GENERIK'],
            ['id' => 3, 'name' => 'NONE'],
            ['id' => 4, 'name' => 'CHEMO'],
            ['id' => 5, 'name' => 'CHRONIS'],
        ];
        foreach ($data as $item) {
            DB::table('medicine_types')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'created_at'=> Carbon::now()
            ]);
        }
    }
}
