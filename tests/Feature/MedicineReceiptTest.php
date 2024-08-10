<?php

namespace Tests\Feature;

use App\Models\MedicineReceiptDetail;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MedicineReceiptTest extends TestCase
{
    public function test_resep_obat_valid_with_medicine_master_data()
    {
        DB::beginTransaction();
        $queueId = fake()->randomElement([1, 2]);
        $medicineId = fake()->randomElement([31, 14]);
        $jumlah = fake()->randomDigitNot(0);
        $aturanPakai = '2x1 (Tablet) Sesudah Makan';
        $nmObat = null;
        $satuanObat = null;

        $response = $this->post('/rajal/resep/dokter/store/' . $queueId, [
            'user_id' => 15,
            'medicine_id' => $medicineId,
            'jumlah' => $jumlah,
            'aturan_pakai' => $aturanPakai,
            'nama_obat_custom' => $nmObat,
            'satuan_obat_custom' => $satuanObat,
        ]);
        
        $resepDetail = MedicineReceiptDetail::latest()->first();
        $response->assertStatus(302)
                 ->assertSessionHas([
                    'success' => 'Berhasil Ditambahkan',
                    'btn' => 'resep dokter',
                 ]);
        $this->assertDatabaseHas('medicine_receipt_details', [
            'id' => $resepDetail->id,
            'medicine_id' => $medicineId,
            'jumlah' => $jumlah,
            'aturan_pakai' => $aturanPakai,
            'nama_obat_custom' => $nmObat,
            'satuan_obat_custom' => $satuanObat,
        ]);
        DB::rollBack();
    }

    public function test_resep_obat_valid_without_medicine_master_data()
    {
        DB::beginTransaction();
        $queueId = fake()->randomElement([1, 2]);
        $jumlah = fake()->randomDigitNot(0);
        $aturanPakai = '2x1 (Kaplet) Sesudah Makan';
        $nmObat = 'Paracetamol 500 MG TAB';
        $satuanObat = 'Kaplet';

        $response = $this->post('/rajal/resep/dokter/store/' . $queueId, [
            'user_id' => 15,
            'jumlah' => $jumlah,
            'aturan_pakai' => $aturanPakai,
            'nama_obat_custom' => $nmObat,
            'satuan_obat_custom' => $satuanObat,
        ]);
        
        $resepDetail = MedicineReceiptDetail::latest()->first();
        $response->assertStatus(302)
                 ->assertSessionHas([
                    'success' => 'Berhasil Ditambahkan',
                    'btn' => 'resep dokter',
                 ]);
        $this->assertDatabaseHas('medicine_receipt_details', [
            'id' => $resepDetail->id,
            'jumlah' => $jumlah,
            'aturan_pakai' => $aturanPakai,
            'nama_obat_custom' => $nmObat,
            'satuan_obat_custom' => $satuanObat,
        ]);
        DB::rollBack();
    }

    public function test_resep_obat_invalid_data()
    {
        $response = $this->post('/rajal/resep/dokter/store/' . fake()->randomElement([1,2]), [
            'user_id' => 15,
            'jumlah' => 0, //jumlah yang tidak valid
            'aturan_pakai' => 34, //aturan pakai yang tidak valid karena bukan string
            'nama_obat_custom' => null, 
            'satuan_obat_custom' => null,
        ]);

        //periksa pengembalian atau pengalihan halaman
        // Periksa field-field yang diharapkan gagal validasi
        $response->assertStatus(302)
                 ->assertSessionHasErrors(['medicine_id','jumlah', 'aturan_pakai', 'nama_obat_custom']);
    }
}
