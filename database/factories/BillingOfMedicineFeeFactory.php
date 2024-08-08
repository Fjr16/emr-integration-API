<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BillingOfMedicineFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rajal_farmasi_obat_detail_id' => fake()->randomDigit(),
            'kode_obat' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'nama_obat' => fake()->name(),
            'satuan_obat' => fake()->word(),
            'jumlah' => fake()->randomDigit(),
            'tarif' => 10000,
            'sub_total' => 10000,
            'ditanggung_asuransi' => mt_rand(0,1),
        ];
    }
}
