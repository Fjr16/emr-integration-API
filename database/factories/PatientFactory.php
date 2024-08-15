<?php

namespace Database\Factories;

use Faker\Provider\id_ID\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'job_id' => fake()->randomDigit(),
            'province_id' => fake()->randomDigit(),
            'city_id' => fake()->randomDigit(),
            'district_id' => fake()->randomDigit(),
            'village_id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'tempat_lhr' => fake()->city(),
            'tanggal_lhr' => fake()->date(),
            'jenis_kelamin' => Person::GENDER_MALE,
            'telp' => fake()->phoneNumber(),
            'agama' => 'Islam',
            'alamat' => fake()->address(),
            'rw' => '00',
            'rt' => '00',
            'pendidikan' => 'S1',
            'nm_ayah' => fake()->name(),
            'nm_ibu' => fake()->name(),
            'nm_wali' => fake()->name(),
            'nik' => fake()->nik(),
            'alergi_makanan' => fake()->word(),
            'alergi_obat' => fake()->word(),
            'suku' => fake()->text(),
            'bangsa' => fake()->country(),
            'status' => fake()->text(),
        ];
    }
}
