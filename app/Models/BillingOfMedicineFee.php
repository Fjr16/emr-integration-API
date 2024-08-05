<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingOfMedicineFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_patient_id',
        'rajal_farmasi_obat_detail_id',  //relasi ke detail resep farmasi
        'kode_obat',
        'nama_obat',
        'satuan_obat',
        'jumlah',
        'tarif',
        'sub_total',
        'ditanggung_asuransi',
    ];

    public function rajalFarmasiObatDetail(){
        return $this->belongsTo(RajalFarmasiObatDetail::class);
    }
}
