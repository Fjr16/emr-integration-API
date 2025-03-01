<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->delete();
        $json = file_get_contents(public_path('dbLama/listJob.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('jobs')->insert([
                'name' => $item['data'],
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
