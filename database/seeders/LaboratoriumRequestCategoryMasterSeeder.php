<?php

namespace Database\Seeders;

use App\Models\LaboratoriumRequestCategoryMaster;
use Illuminate\Database\Seeder;

class LaboratoriumRequestCategoryMasterSeeder extends Seeder
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
                'name' => 'HEMATOLOGI',
            ],
            [
                'name' => 'KIMIA KLINIK',
            ],
            [
                'name' => 'URINE LENGKAP',
            ],
            [
                'name' => 'SEROLOGI / IMUNOLOGI',
            ],
        ];

        foreach ($categories as $category) {
            if(!LaboratoriumRequestCategoryMaster::where('name', $category['name'])->exists()){
                // DB::table('laboratorium_request_category_masters')->insert($category);
                LaboratoriumRequestCategoryMaster::create($category);
            }
        }
    }
}
