<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMedicineReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'rawat_inap_patient_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function ranapMedicineReceiptDetails(){
        return $this->hasMany(RanapMedicineReceiptDetail::class);
    }
}
