<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDischargeSummary extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_patient_id',
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
        'ttd',
        'ttd_admisi',
    ];

    public function kemoterapiPatient()
    {
        return $this->belongsTo(KemoterapiPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Detail Tabel
    public function kemoterapiDetailDiganosaUtamaPatients()
    {
        return $this->hasMany(KemoterapiDetailDiagnosaUtamaPatient::class);
    }
    public function kemoterapiDetailKarmobiditasPatients()
    {
        return $this->hasMany(KemoterapiDetailKarmobiditasPatient::class);
    }
    public function kemoterapiDetailProsedurTerapiPatients()
    {
        return $this->hasMany(KemoterapiDetailProsedurTerapiPatient::class);
    }
    public function kemoterapiDetailObatDirawatPatients()
    {
        return $this->hasMany(KemoterapiDetailObatDirawatPatient::class);
    }
    public function kemoterapiDetailObatDirumahPatients()
    {
        return $this->hasMany(KemoterapiDetailObatDirumahPatient::class);
    }
}
