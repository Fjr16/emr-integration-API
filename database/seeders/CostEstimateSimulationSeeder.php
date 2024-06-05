<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostEstimateSimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            // start Kelas 3
            [
                'name' => 'Adm',
                'harga' =>  350000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Biaya kamar kelas 3',
                'harga' => 400000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Biaya pelayanan kamar bedah',
                'harga' => 1100000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Biaya pelayanan ruang recovery',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Obat Anastesi',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Bahan OK',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Biaya jasa dokter',
                'harga' => 1500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Biaya jasa anastesi',
                'harga' => 600000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Konsultasi dokter',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Visite dokter',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Obat-obatan',
                'harga' => 2000000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Tindakan / Parasat',
                'harga' => 300000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Rontgen',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            [
                'name' => 'Labor',
                'harga' => 500000,
                'kategori' => 'KELAS 3',
            ],
            //end kelas 3
            // start Kelas 2
            [
                'name' => 'Adm',
                'harga' =>  350000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Biaya kamar kelas 2',
                'harga' => 600000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Biaya pelayanan kamar bedah',
                'harga' => 1300000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Biaya pelayanan ruang recovery',
                'harga' => 600000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Obat Anastesi',
                'harga' => 500000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Bahan OK',
                'harga' => 500000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Biaya jasa dokter',
                'harga' => 1650000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Biaya jasa anastesi',
                'harga' => 660000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Konsultasi dokter',
                'harga' => 500000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Visite dokter',
                'harga' => 500000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Obat-obatan',
                'harga' => 2000000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Tindakan / Parasat',
                'harga' => 300000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Rontgen',
                'harga' => 500000,
                'kategori' => 'KELAS 2',
            ],
            [
                'name' => 'Labor',
                'harga' => 500000,
                'kategori' => 'KELAS 2',
            ],
            //end kelas 2
            // start Kelas 1
            [
                'name' => 'Adm',
                'harga' =>  350000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Biaya kamar kelas 1',
                'harga' => 1100000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Biaya pelayanan kamar bedah',
                'harga' => 1500000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Biaya pelayanan ruang recovery',
                'harga' => 700000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Obat Anastesi',
                'harga' => 500000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Bahan OK',
                'harga' => 500000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Biaya jasa dokter',
                'harga' => 1800000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Biaya jasa anastesi',
                'harga' => 720000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Konsultasi dokter',
                'harga' => 500000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Visite dokter',
                'harga' => 500000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Obat-obatan',
                'harga' => 2000000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Tindakan / Parasat',
                'harga' => 300000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Rontgen',
                'harga' => 500000,
                'kategori' => 'KELAS 1',
            ],
            [
                'name' => 'Labor',
                'harga' => 500000,
                'kategori' => 'KELAS 1',
            ],
            //end kelas 1
            // start VIP
            [
                'name' => 'Adm',
                'harga' =>  350000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Biaya kamar VIP',
                'harga' => 1500000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Biaya pelayanan kamar bedah',
                'harga' => 1700000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Biaya pelayanan ruang recovery',
                'harga' => 800000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Obat Anastesi',
                'harga' => 500000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Bahan OK',
                'harga' => 500000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Biaya jasa dokter',
                'harga' => 1950000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Biaya jasa anastesi',
                'harga' => 780000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Konsultasi dokter',
                'harga' => 500000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Visite dokter',
                'harga' => 500000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Obat-obatan',
                'harga' => 2000000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Tindakan / Parasat',
                'harga' => 300000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Rontgen',
                'harga' => 500000,
                'kategori' => 'VIP',
            ],
            [
                'name' => 'Labor',
                'harga' => 500000,
                'kategori' => 'VIP',
            ],
            //end VIP
        ];

        foreach($arr as $item) {
            DB::table('cost_estimate_simulations')->insert([
                'name' => $item['name'],
                'harga' => $item['harga'],
                'kategori' => $item['kategori'],
            ]);
        }
    }
}
