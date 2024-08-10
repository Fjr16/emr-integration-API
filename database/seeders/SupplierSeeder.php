<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->delete();
        $faker = Factory::create('id_ID');
        for ($i=0; $i <= 10; $i++) {
            DB::table('suppliers')->insert([
                'name' => fake()->domainWord(),
                'alamat' => $faker->address(),
                'telp' => $faker->phoneNumber(),
                'npwp' => $faker->nik(),
                'no_izin' => $faker->randomNumber(5, false),
                'contact_person_name' => $faker->name(),
                'contact_person_phone' => $faker->phoneNumber(),
            ]);
        }
    }
}
