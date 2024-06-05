<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDischargeSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'anamnesis',
        'indikasi',
        'riwayat_penyakit',
        'pemeriksaan_fisik',
        'pemeriksaan_diagnostik',
        'kondisi_pasien',
        'intruksi',
        'tindak_lanjut',
        'dokter_pengirim',
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

    //Detail Tabel
    public function ranapDetailDiganosaUtamaPatients(){
        return $this->hasMany(RanapDetailDiganosaUtamaPatient::class);
    }
    public function ranapDetailKarmobiditasPatients(){
        return $this->hasMany(RanapDetailKarmobiditasPatient::class);
    }
    public function ranapDetailProsedurTerapiPatients(){
        return $this->hasMany(RanapDetailProsedurTerapiPatient::class);
    }
    public function ranapDetailObatDirawatPatients(){
        return $this->hasMany(RanapDetailObatDirawatPatient::class);
    }
    public function ranapDetailObatDirumahPatients(){
        return $this->hasMany(RanapDetailObatDirumahPatient::class);
    }
}
