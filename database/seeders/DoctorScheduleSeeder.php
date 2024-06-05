<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(public_path('dbLama/doctor_schedule.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('doctors_schedules')->insert([
                'user_id' => $item['id_dokter'],
                'day' => $item['id_hari'],
                'start_at' => $item['jam_mulai'],
                'ends_at' => $item['jam_selesai'],
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
