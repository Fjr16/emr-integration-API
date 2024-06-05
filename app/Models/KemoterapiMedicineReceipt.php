<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiMedicineReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'patient_id',
        'kemoterapi_patient_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function kemoterapiPatient()
    {
        return $this->belongsTo(KemoterapiPatient::class);
    }
    public function kemoterapiMedicineReceiptDetails()
    {
        return $this->hasMany(KemoterapiMedicineReceiptDetail::class);
    }
}
