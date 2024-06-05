<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapInitialAssesment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'tanggal',
        'isPasien',
        'name',
        'hubungan',
        'keluhan_utama',
        'riwayat_penyakit_sekarang',
        'riwayat_penyakit_dahulu',
        'riwayat_penggunaan_obat',
        'riwayat_penyakit_keluarga',
        'status_lokalis',
        'diagnosa_kerja',
        'diagnosa_banding',
        'terapi',
        'dijelaskan_kepada',
        'isActive',
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

    public function ranapPemeriksaanFisikInitialAssesments(){
        return $this->hasMany(RanapPemeriksaanFisikInitialAssesment::class);
    }

    public function ranapRencanaInitialAssesments(){
        return $this->hasMany(RanapRencanaInitialAssesment::class);
    }

    public function ranapKebutuhanEdukasiInitialAssesments(){
        return $this->hasMany(RanapKebutuhanEdukasiInitialAssesment::class);
    }
    public function ranapRencanaPemulanganPasienInitialAssesments(){
        return $this->hasMany(RanapRencanaPemulanganPasienInitialAssesment::class);
    }
    public function ranapHasilPemeriksaanPenunjangInitialAssesment(){
        return $this->hasMany(RanapHasilPemeriksaanPenunjangInitialAssesment::class);
    }
}
