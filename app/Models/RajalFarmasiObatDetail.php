<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalFarmasiObatDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rajal_farmasi_obat_invoice_id',
        'medicine_id',
        'medicine_stok_id',
        'unit_id',
        'harga_satuan',
        'jumlah',
        'total_harga',
        'patient_category_id',
    ];

    public function rajalFarmasiObatInvoice(){
        return $this->belongsTo(RajalFarmasiObatInvoice::class);
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
    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
}
