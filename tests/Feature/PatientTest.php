<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Patient;
use Faker\Factory;

class PatientTest extends TestCase
{
    public function test_patient_valid_data()
    {
        $faker = Factory::create('id_ID');
        $response = $this->post('/pasien/store', [
            'job_id' => fake()->randomDigitNotNull(),
            'province_id' => fake()->randomDigitNotNull(),
            'city_id' => fake()->randomDigitNotNull(),
            'district_id' => fake()->randomDigitNotNull(),
            'village_id' => fake()->randomDigitNotNull(),
            'name' => fake()->name(),
            'tempat_lhr' => fake()->city(),
            'tanggal_lhr' => fake()->date(),
            'jenis_kelamin' => $faker->randomElement(['Pria', 'Wanita']),
            'telp' => fake()->phoneNumber(),
            'agama' => $faker->randomElement(['Islam', 'Budha', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Konghucu', 'dll']),
            'alamat' => fake()->address(),
            'rw' => '00',
            'rt' => '00',
            'pendidikan' => $faker->randomElement(['TIDAK SEKOLAH', 'PAUD', 'TK','SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3']),
            'status' => $faker->randomElement(['Kawin', 'Belum Kawin']),
            'nm_ayah' => fake()->name(),
            'nm_ibu' => fake()->name(),
            'nm_wali' => fake()->name(),
            'nik' => $faker->nik(),
            'alergi_makanan' => fake()->text(),
            'alergi_obat' => fake()->text(),
            'suku' => fake()->word(),
            'bangsa' => fake()->country(),
        ]);

        $response->assertStatus(200);
        $patient = Patient::latest()->first();
        $this->assertDatabaseHas('patients', [
            'id' => $patient->id,
            'name' => $patient->name,
        ]);
    }

    public function test_patient_invalid_data()
    {
        $response = $this->post('/pasien/store', [
            'job_id' => 500, //menggunakan job_id yang tidak ada
            'province_id' => null,  //provinsi kosong
            'city_id' => null, //kota kosong
            'district_id' => null, //kecamatan kosong
            'village_id' => null, //desa kosong
            'name' => fake()->name(),
            'tempat_lhr' => fake()->city(),
            'tanggal_lhr' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement(['Pria', 'Wanita']),
            'telp' => null, //telp kosong
            'agama' => fake()->randomElement(['Islam', 'Budha', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Konghucu', 'dll']),
            'alamat' => fake()->address(),
            'rw' => '00',
            'rt' => '00',
            'pendidikan' => fake()->randomElement(['TIDAK SEKOLAH', 'PAUD', 'TK','SD', 'SMP / MTS / SLTP SEDERAJAT', 'SMA / SMK / SLTA SEDERAJAT', 'S1', 'S2', 'S3']),
            'status' => fake()->randomElement(['Kawin', 'Belum Kawin']),
            'nm_ayah' => fake()->name(),
            'nm_ibu' => fake()->name(),
            'nm_wali' => fake()->name(),
            'nik' => 13090416080001,    //menggunakan nik yang sudah ada
            'alergi_makanan' => fake()->text(),
            'alergi_obat' => fake()->text(),
            'suku' => fake()->word(),
            'bangsa' => fake()->country(),
        ]);

        //periksa pengembalian atau pengalihan halaman
        // Periksa field-field yang diharapkan gagal validasi
        $response->assertStatus(302)
                 ->assertSessionHasErrors(['job_id', 'province_id', 'city_id', 'district_id', 'village_id', 'telp', 'nik']);
    }
}
