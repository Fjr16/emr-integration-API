<?php

namespace Database\Seeders;

use App\Models\DiagnosisPatient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosisPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = file_get_contents(public_path('dbLama/bpjs_diagnosa.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('diagnosis_patients')->insert([
                'code' => $item['code'],
                'deskripsi' => $item['deskripsi'],
            ]);
        }
    }
}
