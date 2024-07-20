<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->delete();
        $json = file_get_contents(public_path('dbLama/medicines-bank.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('medicines')->insert([
                'id' => $item['id'],
                'medicine_type_id' => $item['medicine_type_id'],
                'medicine_category_id' => $item['medicine_category_id'],
                'medicine_form_id' => $item['medicine_form_id'],
                'kode' => $item['kode'],
                'name' => $item['name'],
                'small_unit' => $item['small_unit'],
                'small_to_medium' => $item['medium_to_small'] ?? null,
                'medium_unit' => $item['medium_unit'],
                'medium_to_big' => $item['big_to_medium'] ?? null,
                'big_unit' => $item['big_unit'],
                'base_harga' => 0,  //integer Rp
                'disc' => 0,    // integer Rp
                'pajak' => 0,   // integer Rp
                'created_at' => Carbon::now(),
                'updated_at' =>NULL,
            ]);
        }
    }
}
