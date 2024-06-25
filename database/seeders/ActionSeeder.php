<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                "action_category_id" => 5,
                "icd_code" => "93.35",
            ],
            [
                "name" => "Latihan Pergerakan Sendi",
                "action_category_id" => 5,
                "icd_code" => "93.14",
            ],
            [
                "name" => "Latihan Bagian Tubuh yang Kaku",
                "action_category_id" => 5,
                "icd_code" => "93.13",
            ],
            [
                "name" => "Latihan Pernafasan",
                "action_category_id" => 5,
                "icd_code" => "93.18",
            ],
            [
                "name" => "Latihan Muskuloskeletal Aktif lainnya",
                "action_category_id" => 5,
                "icd_code" => "93.12",
            ],
            [
                "name" => "Latihan Muskuloskeletal Pasif Lainnya",
                "action_category_id" => 5,
                "icd_code" => "93.17",
            ],
            [
                "name" => "Excercise, Unsp",
                "action_category_id" => 5,
                "icd_code" => "93.19",
            ],

            // tindakan/parasat
            [
                "name" => "Buka gips",
                "action_category_id" => 4,
                "icd_code" => "97.88",
            ],
            [
                "name" => "Endoskopi Sinonasal",
                "action_category_id" => 4,
                "icd_code" => "22.19",
            ],
            [
                "name" => "Endoskopi Telinga / Otoscopy",
                "action_category_id" => 4,
                "icd_code" => "18.19",
            ],
            [
                "name" => "Tukar Verban Kecil",
                "action_category_id" => 4,
                "icd_code" => "93.57",
            ],
            [
                "name" => "Tukar Verban Sedang",
                "action_category_id" => 4,
                "icd_code" => "93.57",
            ],
            [
                "name" => "Tukar Verban Besar",
                "action_category_id" => 4,
                "icd_code" => "93.57",
            ],

            // labor pk
            [
                "name" => "Kultur Darah",
                "action_category_id" => 2,
                "icd_code" => "90.53",
            ],
            // radiologi
            [
                "name" => "Photo Abdomen 2 Posisi",
                "action_category_id" => 1,
                "icd_code" => "87.65",
            ],
            [
                "name" => "Thorax",
                "action_category_id" => 1,
                "icd_code" => "87.49",
            ],
            [
                "name" => "Pelvis",
                "action_category_id" => 1,
                "icd_code" => "88.26",
            ],
            [
                "name" => "Cranium",
                "action_category_id" => 1,
                "icd_code" => "87.17",
            ],
            [
                "name" => "Lumbo Sacral",
                "action_category_id" => 1,
                "icd_code" => "87.24",
            ],
            [
                "name" => "Femur",
                "action_category_id" => 1,
                "icd_code" => "88.27",
            ],
            [
                "name" => "Cruris",
                "action_category_id" => 1,
                "icd_code" => "88.27",
            ],
            [
                "name" => "Genu",
                "action_category_id" => 1,
                "icd_code" => "88.27",
            ],
            [
                "name" => "Ankle / Talocruralis",
                "action_category_id" => 1,
                "icd_code" => "88.28",
            ],
            [
                "name" => "Cubiti / Siku",
                "action_category_id" => 1,
                "icd_code" => "88.22",
            ],
            [
                "name" => "Wrist Joint / Pergelangan tangan",
                "action_category_id" => 1,
                "icd_code" => "88.23",
            ],
        ];
        foreach ($data as $item){
            DB::table('actions')->insert($item);
        }
    }
}
