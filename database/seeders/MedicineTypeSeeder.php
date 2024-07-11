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
        DB::table('medicine_types')->delete();
        $data = [
            ['id' => 1, 'name' => 'OBAT GENERIK'],
            ['id' => 2, 'name' => 'OBAT PATEN'],
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
