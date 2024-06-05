<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'room_id' => 1,
                'name' => 'Poli THT',
                'kode_poli' => 'Poli 6',
                'kode_dokter_poli' => 'A',
            ],
            [
                'id' => 2,
                'room_id' => 1,
                'name' => 'Poli Jantung',
                'kode_poli' => 'Poli 5',
                'kode_dokter_poli' => 'B',
            ],
            [
                'id' => 3,
                'room_id' => 1,
                'name' => 'Poli Penyakit Dalam',
                'kode_poli' => 'Poli 3',
                'kode_dokter_poli' => 'C',
            ],
            [
                'id' => 4,
                'room_id' => 1,
                'name' => 'Poli Penyakit Dalam',
                'kode_poli' => 'Poli 3',
                'kode_dokter_poli' => 'D',
            ],
            [
                'id' => 5,
                'room_id' => 1,
                'name' => 'Poli Onkologi',
                'kode_poli' => 'Poli 2',
                'kode_dokter_poli' => 'E',
            ],
            [
                'id' => 6,
                'room_id' => 1,
                'name' => 'Poli Penyakit Dalam',
                'kode_poli' => 'Poli 5',
                'kode_dokter_poli' => 'F',
            ],
            [
                'id' => 7,
                'room_id' => 1,
                'name' => 'Poli Orthopedi',
                'kode_poli' => 'Poli 1',
                'kode_dokter_poli' => 'G',
            ],
            [
                'id' => 8,
                'room_id' => 1,
                'name' => 'Poli Bedah Umum',
                'kode_poli' => 'Poli 4',
                'kode_dokter_poli' => 'H',
            ],
            [
                'id' => 9,
                'room_id' => 1,
                'name' => 'Poli Urologi',
                'kode_poli' => 'Poli 3',
                'kode_dokter_poli' => 'I',
            ],
            [
                'id' => 10,
                'room_id' => 1,
                'name' => 'Poli Orthopedi',
                'kode_poli' => 'Poli 1',
                'kode_dokter_poli' => 'J',
            ],
            [
                'id' => 11,
                'room_id' => 1,
                'name' => 'Poli Bedah Umum',
                'kode_poli' => 'Poli 4',
                'kode_dokter_poli' => 'K',
            ],
        ];

        foreach ($data as $item) {
            DB::table('room_details')->insert([
                'id' => $item['id'],
                'name' => $item['name'],
                'room_id' => $item['room_id'],
                'kode_poli' => $item['kode_poli'],
                'kode_dokter_poli' => $item['kode_dokter_poli'],
                'isActive' => 1,
            ]);
        }
    }
}
