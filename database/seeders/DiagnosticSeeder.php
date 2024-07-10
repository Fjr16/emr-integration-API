<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnostics')->delete();

        $json = file_get_contents(public_path('dbLama/bpjs_diagnosa.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('diagnostics')->insert([
                'icd_x_code' => $item['code'],
                'name' => $item['deskripsi'],
            ]);
        }
    }
}
