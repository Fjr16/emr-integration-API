<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'rawat_jalan_poli_patient_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function rawatJalanPoliPatient(){
        return $this->belongsTo(RawatJalanPoliPatient::class);
    }
    public function medicineReceiptDetails(){
        return $this->hasMany(MedicineReceiptDetail::class);
    }
}
