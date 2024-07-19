<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalFarmasiObatDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rajal_farmasi_patient_id',
        'medicine_id',
        'medicine_stok_id',
        'unit_id',
        'nama_obat',
        'aturan_pakai',
        'jumlah',
        'satuan_obat',
        'harga_satuan',
        'sub_total',
        'ditanggung_asuransi',
    ];

    public function rajalFarmasiPatient(){
        return $this->belongsTo(RajalFarmasiPatient::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
    public function medicineStok(){
        return $this->belongsTo(MedicineStok::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
