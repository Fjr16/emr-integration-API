<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMppPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'room_detail_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'kelas_rawatan',
        'tindakan',
        'diagnosa',
        'total_skor_minor',
        'total_skor_major',
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
    public function roomDetail(){
        return $this->belongsTo(roomDetail::class);
    }
    public function ranapMppSkriningPatients(){
        return $this->hasMany(RanapMppSkriningPatient::class);
    }
    public function ranapMppProblemRiskChances(){
        return $this->hasMany(RanapMppProblemRiskChance::class);
    }
    public function ranapMppAssesManagements(){
        return $this->hasMany(RanapMppAssesManagement::class);
    }
    public function ranapMppManagerPlanning(){
        return $this->hasOne(RanapMppManagerPlanning::class);
    }
    public function ranapMppPelayananAdvanceds(){
        return $this->hasMany(RanapMppPelayananAdvanced::class);
    }
}
