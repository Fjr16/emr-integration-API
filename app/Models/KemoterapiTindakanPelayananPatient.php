<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiTindakanPelayananPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_patient_id',
        'patient_id',
        'user_id',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    public function kemoterapiPatient(){
        return $this->belongsTo(KemoterapiPatient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function kemoterapiTindakanPelayananPatientDetails(){
        return $this->hasMany(KemoterapiTindakanPelayananPatientDetail::class);
    }
}
