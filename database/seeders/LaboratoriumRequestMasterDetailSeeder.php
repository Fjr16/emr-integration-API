<?php

namespace Database\Seeders;

use App\Models\LaboratoriumRequestMasterDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoriumRequestMasterDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hemoglobin = [
            [
                'laboratorium_request_master_variable_id' => 1,
                'name' => 'Perempuan',
                'alias' => 'P',
                'from' => 12,
                'to' => 16,
                'unit' => 'g/dl',
            ],
            [
                'laboratorium_request_master_variable_id' => 1,
                'name' => 'Laki-Laki',
                'alias' => 'L',
                'from' => 14,
                'to' => 18,
                'unit' => 'g/dl',
            ],
        ];
        $leukosit = [
            [
                'laboratorium_request_master_variable_id' => 2,
                'name' => null,
                'alias' => null,
                'from' => 5000,
                'to' => 10000,
                'unit' => 'mm^3',
            ],
        ];
        $led = [
            [
                'laboratorium_request_master_variable_id' => 3,
                'name' => 'Perempuan',
                'alias' => 'P',
                'from' => 0,
                'to' => 15,
                'unit' => 'mm',
            ],
            [
                'laboratorium_request_master_variable_id' => 3,
                'name' => 'Laki-Laki',
                'alias' => 'L',
                'from' => 0,
                'to' => 10,
                'unit' => 'mm',
            ],
        ];
        $eritrosit = [
            [
                'laboratorium_request_master_variable_id' => 4,
                'name' => 'Perempuan',
                'alias' => 'P',
                'from' => 4000000,
                'to' => 4500000,
                'unit' => 'mm',
            ],
            [
                'laboratorium_request_master_variable_id' => 4,
                'name' => 'Laki-Laki',
                'alias' => 'L',
                'from' => 4000000,
                'to' => 5500000,
                'unit' => 'mm',
            ],
        ];
        $trombosit = [
            [
                'laboratorium_request_master_variable_id' => 5,
                'name' => null,
                'alias' => null,
                'from' => 150000,
                'to' => 400000,
                'unit' => 'mm^3',
            ],
        ];
        $hematokrit = [
            [
                'laboratorium_request_master_variable_id' => 6,
                'name' => 'Perempuan',
                'alias' => 'P',
                'from' => 37,
                'to' => 43,
                'unit' => '%',
            ],
            [
                'laboratorium_request_master_variable_id' => 6,
                'name' => 'Laki-Laki',
                'alias' => 'L',
                'from' => 40,
                'to' => 48,
                'unit' => '%',
            ],
        ];
        $hitungJenis = [
            [
                'laboratorium_request_master_variable_id' => 7,
                'name' => null,
                'alias' => null,
                'from' => 0,
                'to' => 1,
                'unit' => '%',
            ],
            [
                'laboratorium_request_master_variable_id' => 8,
                'name' => null,
                'alias' => null,
                'from' => 1,
                'to' => 3,
                'unit' => '%',
            ],
            [
                'laboratorium_request_master_variable_id' => 9,
                'name' => null,
                'alias' => null,
                'from' => 2,
                'to' => 6,
                'unit' => '%',
            ],
            [
                'laboratorium_request_master_variable_id' => 10,
                'name' => null,
                'alias' => null,
                'from' => 50,
                'to' => 70,
                'unit' => '%',
            ],
            [
                'laboratorium_request_master_variable_id' => 11,
                'name' => null,
                'alias' => null,
                'from' => 20,
                'to' => 40,
                'unit' => '%',
            ],
            [
                'laboratorium_request_master_variable_id' => 12,
                'name' => null,
                'alias' => null,
                'from' => 2,
                'to' => 8,
                'unit' => '%',
            ],
        ];
        $retikulosit = [
            [
                'laboratorium_request_master_variable_id' => 13,
                'name' => null,
                'alias' => null,
                'from' => 0.5,
                'to' => 2,
                'unit' => '%',
            ],
        ];
        $mcv = [
            [
                'laboratorium_request_master_variable_id' => 14,
                'name' => null,
                'alias' => null,
                'from' => 82,
                'to' => 92,
                'unit' => 'fL',
            ],
        ];
        $mch = [
            [
                'laboratorium_request_master_variable_id' => 15,
                'name' => null,
                'alias' => null,
                'from' => 27,
                'to' => 31,
                'unit' => 'pg',
            ],
        ];
        $mchc = [
            [
                'laboratorium_request_master_variable_id' => 16,
                'name' => null,
                'alias' => null,
                'from' => 32,
                'to' => 36,
                'unit' => '%',
            ],
        ];
        $pendarahan = [
            [
                'laboratorium_request_master_variable_id' => 17,
                'name' => null,
                'alias' => null,
                'from' => 2,
                'to' => 6,
                'unit' => 'menit',
            ],
        ];
        $pembekuan = [
            [
                'laboratorium_request_master_variable_id' => 18,
                'name' => null,
                'alias' => null,
                'from' => 1,
                'to' => 6,
                'unit' => 'menit',
            ],
        ];

        $data = [
            $hemoglobin,
            $leukosit,
            $led,
            $eritrosit,
            $trombosit,
            $hematokrit,
            $hitungJenis,
            $retikulosit,
            $mcv,
            $mch,
            $mchc,
            $pendarahan,
            $pembekuan,
        ];

        foreach ($data as $item) {
            foreach ($item as $detail) {
                if(!LaboratoriumRequestMasterDetail::where('laboratorium_request_master_variable_id', $detail['laboratorium_request_master_variable_id'])->where('name', $detail['name'])->where('alias', $detail['alias'])->where('from', $detail['from'])->where('to', $detail['to'])->where('unit', $detail['unit'])->exists()){
                    DB::table('laboratorium_request_master_details')->insert($detail);
                }
            }
        }
    }
}
