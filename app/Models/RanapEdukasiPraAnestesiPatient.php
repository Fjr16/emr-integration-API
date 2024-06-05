<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapEdukasiPraAnestesiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'tgl',
        'rencana_tindakan',
        'jenis_anestesi',
        'ttd_user',
        'ttd_wali_patient',
    ];

    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ranapDetailEdukasiPraAnestesiPatients(){
        return $this->hasMany(RanapDetailEdukasiPraAnestesiPatient::class);
    }
}
