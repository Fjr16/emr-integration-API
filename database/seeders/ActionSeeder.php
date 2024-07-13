<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->delete();
        $data = [
            [
                "name" => "Infra Red Radiasi",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.33",
            ],
            [
                "name" => "Latihan Pergerakan Sendi",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.14",
            ],
            [
                "name" => "Latihan Bagian Tubuh yang Kaku",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.13",
            ],
            [
                "name" => "Latihan Pernafasan",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.18",
            ],
            [
                "name" => "Latihan Muskuloskeletal Aktif lainnya",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.12",
            ],
            [
                "name" => "Latihan Muskuloskeletal Pasif Lainnya",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.17",
            ],
            [
                "name" => "Excercise, Unsp",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.19",
            ],
            [
                "name" => "Buka gips",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "97.88",
            ],
            [
                "name" => "Endoskopi Sinonasal",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "22.19",
            ],
            [
                "name" => "Endoskopi Telinga / Otoscopy",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "18.19",
            ],
            [
                "name" => "Tukar Verban Kecil",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.57",
            ],
            [
                "name" => "Tukar Verban Sedang",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.57",
            ],
            [
                "name" => "Tukar Verban Besar",
                "jenis_tindakan" => 'Tindakan Pelayanan Medis',
                "action_code" => "93.57",
            ],

            // laboratorium
            [
                "name" => "Kultur Darah",
                "jenis_tindakan" => 'Laboratorium',
                "action_code" => "90.53",
            ],
            // radiologi
            [
                "name" => "Photo Abdomen 2 Posisi",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "87.65",
            ],
            [
                "name" => "Thorax",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "87.49",
            ],
            [
                "name" => "Pelvis",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.26",
            ],
            [
                "name" => "Cranium",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "87.17",
            ],
            [
                "name" => "Lumbo Sacral",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "87.24",
            ],
            [
                "name" => "Femur",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.27",
            ],
            [
                "name" => "Cruris",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.27",
            ],
            [
                "name" => "Genu",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.27",
            ],
            [
                "name" => "Ankle / Talocruralis",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.28",
            ],
            [
                "name" => "Cubiti / Siku",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.22",
            ],
            [
                "name" => "Wrist Joint / Pergelangan tangan",
                "jenis_tindakan" => 'Radiologi',
                "action_code" => "88.23",
            ],
        ];
        foreach ($data as $item){
            DB::table('actions')->insert($item);
        }
    }
}
