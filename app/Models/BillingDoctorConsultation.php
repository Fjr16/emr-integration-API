<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDoctorConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_patient_id',
        'user_id',
        'kode_dokter',
        'nama_dokter',
        'nama_poli',
        'tarif',    //decimal, 10, 2
    ];

    // dokter
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function kasirPatient(){
        return $this->belongsTo(KasirPatient::class);
    }
}
