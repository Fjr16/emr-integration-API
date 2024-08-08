<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillingDoctorConsultation>
 */
class BillingDoctorConsultationFactory extends Factory
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
            'kode_dokter' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'nama_dokter' => fake()->name(),
            'nama_poli' => fake()->name(),
            'tarif' => 30000,
        ];
    }
}
