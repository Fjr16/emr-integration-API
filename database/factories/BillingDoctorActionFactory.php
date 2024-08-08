<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillingDoctorAction>
 */
class BillingDoctorActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->randomDigit(),
            'action_id' => fake()->randomDigit(),
            'patient_category_id' => fake()->randomDigit(),
            'kode_dokter' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'nama_dokter' => fake()->name(),
            'nama_poli' => fake()->name(),
            'kode_tindakan' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'nama_tindakan' => fake()->name(),
            'jumlah' => 1,
            'tarif' => 20000,
            'sub_total' => 20000,
        ];
    }
}
