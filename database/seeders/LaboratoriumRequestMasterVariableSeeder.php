<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LaboratoriumRequestMasterVariable;

class LaboratoriumRequestMasterVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hematologi = [
            [
                'laboratorium_request_category_master_id' => 1,
                'name' => 'Hemoglobin',
                'icd_code' => '341',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Leukosit',
                'icd_code' => '341',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'LED 1 Jam',
                'icd_code' => '341',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Eritrosit',
                'icd_code' => '341',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Trombosit',
                'icd_code' => '341',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hematokrit',
                'icd_code' => '341',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hitung Jenis Basofil',
                'icd_code' => '746',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hitung Jenis Eosinofil',
                'icd_code' => '746',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hitung Jenis N.Batang',
                'icd_code' => '746',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hitung Jenis N.Segmen',
                'icd_code' => '746',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hitung Jenis Limfosit',
                'icd_code' => '746',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Hitung Jenis Monosit',
                'icd_code' => '746',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Retikulosit',
                'icd_code' => '6364',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'MCV',
                'icd_code' => '6364',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'MCH',
                'icd_code' => '6364',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'MCHC',
                'icd_code' => '6364',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Waktu Pendarahan',
                'icd_code' => '6364',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Waktu Pembekuan',
                'icd_code' => '731',
            ],
            [
                'laboratorium_request_category_master_id' => 1, 
                'name' => 'Malaria (mikroskopis)',
                'icd_code' => '731',
            ],
        ];
        
        $kimiaKlinik = [
            [
                'laboratorium_request_category_master_id' => 2,
                'name' => 'Glukosa Darah Puasa',
                'icd_code' => '456',
            ],
            [
                'laboratorium_request_category_master_id' => 2,
                'name' => 'Glukosa Darah 2 Jam PP',
                'icd_code' => '23',
            ],
            [
                'laboratorium_request_category_master_id' => 2,
                'name' => 'Glukosa Darah Sewaktu',
                'icd_code' => '76',
            ],
            [
                'laboratorium_request_category_master_id' => 2,
                'name' => 'Total Kolesterol',
                'icd_code' => '238',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'HDL Kolesterol',
                'icd_code' => '238',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'LDL Kolesterol',
                'icd_code' => '238',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Trigliserida',
                'icd_code' => '878',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Asam Urat',
                'icd_code' => '897',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Ureum',
                'icd_code' => '876',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Kreatinin',
                'icd_code' => '273',
            ],
            [
                'laboratorium_request_category_master_id' => 2,
                'name' => 'SGOT',
                'icd_code' => '273',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'SGPT',
                'icd_code' => '273',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Total Protein',
                'icd_code' => '45',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Albumin',
                'icd_code' => '232',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Globulin',
                'icd_code' => '232',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Bilirubin Total',
                'icd_code' => '3874',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Bilirubin Direct',
                'icd_code' => '3456',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Bilirubin Indirect',
                'icd_code' => '345',
            ],
            [
                'laboratorium_request_category_master_id' => 2, 
                'name' => 'Kalsium',
                'icd_code' => '445',
            ],
        ];

        $urineLengkap = [
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Makroskopis Warna',
                'icd_code' => '976',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Makroskopis Kekeruhan',
                'icd_code' => '567',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Makroskopis pH',
                'icd_code' => '584',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Makroskopis BJ',
                'icd_code' => '456',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Mikroskopis Leukosit',
                'icd_code' => '32',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Mikroskopis Eritrosit',
                'icd_code' => '98',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Mikroskopis Silinder',
                'icd_code' => '8347',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Mikroskopis Kristal',
                'icd_code' => '923',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Mikroskopis Epitel',
                'icd_code' => '8976',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Protein',
                'icd_code' => '23',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Glukosa',
                'icd_code' => '45',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Bilirubin',
                'icd_code' => '453',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Urobilinogen',
                'icd_code' => '2345',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Benda Keton',
                'icd_code' => '9790',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Tes Benzidine',
                'icd_code' => '078098',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Esbach',
                'icd_code' => '0324',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Kimia Protein bence jones',
                'icd_code' => '927',
            ],
            [
                'laboratorium_request_category_master_id' => 3, 
                'name' => 'Plano Test',
                'icd_code' => '5665',
            ],
        ];

        $serologi = [
            [
                'laboratorium_request_category_master_id' => 4, 
                'name' => 'HBsAg (rapid test)',
                'icd_code' => '12',
            ],
            [
                'laboratorium_request_category_master_id' => 4, 
                'name' => 'Anti HIV (rapid test)',
                'icd_code' => '232',
            ],
            [
                'laboratorium_request_category_master_id' => 4, 
                'name' => 'Ca 15-3',
                'icd_code' => '454',
            ],
            [
                'laboratorium_request_category_master_id' => 4, 
                'name' => 'TSH',
                'icd_code' => '3443',
            ],
            [
                'laboratorium_request_category_master_id' => 4, 
                'name' => 'FT 4',
                'icd_code' => '12',
            ],
            [
                'laboratorium_request_category_master_id' => 4, 
                'name' => 'PSA Total',
                'icd_code' => '343',
            ],
        ];

        // $gdt = [
        //     [
        //         'laboratorium_request_category_master_id' => null, 
        //         'name' => 'Eritrosit',
        //         'icd_code' => '45',
        //     ],
        //     [
        //         'laboratorium_request_category_master_id' => null, 
        //         'name' => 'Leukosit',
        //         'icd_code' => '33',
        //     ],
        //     [
        //         'laboratorium_request_category_master_id' => null, 
        //         'name' => 'Trombosit',
        //         'icd_code' => '12',
        //     ],
        // ];


        $allData = [
            $hematologi,
            $kimiaKlinik,
            $urineLengkap,
            $serologi,
            // $gdt,
        ];

        foreach ($allData as $data) {
            foreach ($data as $item) {
                if(!LaboratoriumRequestMasterVariable::where('name', $item['name'])->where('laboratorium_request_category_master_id', $item['laboratorium_request_category_master_id'])->exists()){
                    DB::table('laboratorium_request_master_variables')->insert($item);
                }
            }
        }
    }
}
