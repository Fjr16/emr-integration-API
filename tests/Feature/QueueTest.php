<?php

namespace Tests\Feature;

use App\Models\Queue;
use Tests\TestCase;

class QueueTest extends TestCase
{
    public function test_antrian_valid_data()
    {
        $response = $this->post('/antrian/store', [
            'patient_id' => fake()->randomElement([4,5,6,7]),
            'user_id' => 20,
            'doctor_id' => fake()->randomElement([34,35,36,37]),
            'patient_category_id' => fake()->randomElement([1,18,19,21,22,23]),
            'tgl_antrian' => date('Y-m-d'),
        ]);
        
        $queue = Queue::latest()->first();
        $response->assertStatus(302)
                 ->assertSessionHas(['success' => 'Antrian Berhasil Ditambahkan'])
                 ->assertSessionHas('queue_id', $queue->id);
        $this->assertDatabaseHas('queues', [
            'id' => $queue->id,
        ]);
    }

    public function test_antrian_invalid_data()
    {
        $response = $this->post('/antrian/store', [
            'patient_id' => fake()->randomElement([1,2]), //patient id yang tidak ada
            'user_id' => 20,
            'doctor_id' => fake()->randomDigitNot([0,10]), //dokter_id yang tidak ada
            'patient_category_id' => fake()->randomElement([2,3,4,5,]), //patient_category_id yang tidak ada
            'tgl_antrian' => '2024-07-10', // tanggal sebelum hari ini
        ]);

        //periksa pengembalian atau pengalihan halaman
        // Periksa field-field yang diharapkan gagal validasi
        $response->assertStatus(302)
                 ->assertSessionHasErrors(['patient_id', 'doctor_id', 'patient_category_id', 'tgl_antrian']);
    }
}
