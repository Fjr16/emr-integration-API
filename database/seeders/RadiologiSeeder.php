<?php

namespace Database\Seeders;

use App\Models\RadiologiFormRequestMasterCategory;
use App\Models\RadiologiFormRequestMasterDetail;
use Illuminate\Database\Seeder;

class RadiologiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'EKSTREMITAS ATAS',
            ],
            [
                'id' => 2,
                'name' => 'EKSTREMITAS BAWAH',
            ],
            [
                'id' => 3,
                'name' => 'USG',
            ],
            [
                'id' => 4,
                'name' => 'LAIN-LAIN',
            ],
            [
                'id' => 5,
                'name' => 'KONTRAS',
            ],
            [
                'id' => 6,
                'name' => 'PEMERIKSAAN LAINNYA',
            ],
        ];
        $details = [
            [
                'id' => 1,
                'name' => 'Dextra',
            ],
            [
                'id' => 2,
                'name' => 'Sinitra',
            ],
        ];
        
        foreach($categories as $category){
            RadiologiFormRequestMasterCategory::create($category);
        }
        foreach($details as $detail){
            RadiologiFormRequestMasterDetail::create($detail);
        }
    }
}
