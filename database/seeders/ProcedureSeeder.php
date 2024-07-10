<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedures')->delete();

        $filePath = public_path('dbLama/ICD9.csv');
        $file = fopen($filePath, 'r');

        // skip header row
        fgetcsv($file);

        while(($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            $procedure = new Procedure;
            $procedure->icd_ix_code = $data[0];
            $procedure->name = $data[1];
            $procedure->save();
        }
        fclose($file);
    }
}
