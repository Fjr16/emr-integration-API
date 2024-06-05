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
        $json = file_get_contents(public_path('dbLama/MedicinesData.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('medicines')->insert([
                'id' => $item['id'],
                'medicine_type_id' => $item['medicine_type_id'],
                'medicine_category_id' => $item['medicine_category_id'],
                'medicine_form_id' => $item['medicine_form_id'],
                'kode' => $item['kode'],
                'name' => $item['name'],
                'unit_conversion_master_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' =>NULL,
            ]);
        }
    }
}
