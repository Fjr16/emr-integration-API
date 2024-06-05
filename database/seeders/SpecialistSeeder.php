<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'THT'],
            ['id' => 2, 'name' => 'Jantung'],
            ['id' => 3, 'name' => 'Penyakit Dalam'],
            ['id' => 4, 'name' => 'Onkologi'],
            ['id' => 5, 'name' => 'Orthopedi'],
            ['id' => 6, 'name' => 'Bedah Umum'],
            ['id' => 7, 'name' => 'Urologi'],
        ];

        foreach ($data as $item) {
            Specialist::create($item);
        }
    }
}
