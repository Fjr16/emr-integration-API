<?php

namespace Database\Factories;

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
            'city_id' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'district_id' => fake()->name(),
            'village_id' => 1,
            'no_rm' => 20000,
            'name' => 20000,
            'tempat_lhr' => 20000,
            'tanggal_lhr' => 20000,
            'jenis_kelamin' => 20000,
            'telp' => 20000,
            'agama' => 20000,
            'alamat' => 20000,
            'rw' => 20000,
            'rt' => 20000,
            'pendidikan' => 20000,
            'nm_ayah' => 20000,
            'nm_ibu' => 20000,
            'nm_wali' => 20000,
            'nik' => 20000,
            'alergi_makanan' => 20000,
            'alergi_obat' => 20000,
            'suku' => 20000,
            'bangsa' => 20000,
            'status' => 20000,
        ];
    }
}
