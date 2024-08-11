<?php

namespace Tests\Feature;

use App\Models\RmeCppt;
use Tests\TestCase;

class CpptTest extends TestCase
{
    public function test_cppt_valid_data()
    {
        $queueId = 1;
        $userId = 34;
        $sub = fake()->text();
        $obj = fake()->text();
        $ass = fake()->text();
        $plan = fake()->text();

        $response = $this->post('/rajal/cppt/store/' . $queueId, [
            'user_id' => $userId,
            'subjective' => $sub,
            'objective' => $obj,
            'asesmen' => $ass,
            'planning' => $plan,
        ]);
        
        $cppt = RmeCppt::latest()->first();
        $response->assertStatus(302)
                 ->assertSessionHas([
                    'success' => 'Berhasil Diperbarui',
                    'btn' => 'cppt',
                 ]);
        $this->assertDatabaseHas('rme_cppts', [
            'id' => $cppt->id,
            'queue_id' => $queueId,
            'user_id' => $userId,
            'subjective' => $sub,
            'objective' => $obj,
            'asesment' => $ass,
            'planning' => $plan,
        ]);
    }

    public function test_cppt_invalid_data()
    {
        $response = $this->post('/rajal/cppt/store/' . 1, [
            'user_id' => null,
            'subjective' => 23414,
            'objective' => null,
            'asesment' => null,
            'planning' => 394534,
        ]);

        //periksa pengembalian atau pengalihan halaman
        // Periksa pengembalian flash message error / gagal validasi
        $response->assertStatus(302)
                 ->assertSessionHas('error');
    }
}
