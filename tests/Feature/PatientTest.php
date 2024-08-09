<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient_valid_data()
    {
        $response = $this->post('/pasien/store');

        $response->assertStatus(201);
    }

    public function test_patient_invalid_data()
    {
        $response = $this->post('/pasien/store');

        $response->assertStatus(400);//bad request
        $response->assertStatus(422);//unprocessable entity
        $response->assertStatus(422);//unprocessable entity
    }

    public function test_patient_valid_and_invalid_data()
    {
        $response = $this->post('/pasien/store');

        $response->assertStatus(200);
    }
}
