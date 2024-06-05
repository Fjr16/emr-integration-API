<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapPermintaanKonsulPenyakitDalamPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'room_detail_id',
        'user_id',
        'permintaan',
        'ket_pasien',
        'pemeriksaan_ditemukan',
        'tanggal',
    ];

    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient(){
        return $this->belongsTo(patient::class);
    }
    public function roomDetail(){
        return $this->belongsTo(RoomDetail::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ranapJawabanKonsulPenyakitDalamPatient(){
        return $this->hasOne(RanapJawabanKonsulPenyakitDalamPatient::class);
    }
}
