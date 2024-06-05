<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiInitialAssesment extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_patient_id',
        'patient_id',
        'user_id',
        'tanggal',
        'isPasien',
        'name', //nama penerima info
        'hubungan',
        'keluhan',
        'riwayat_penyakit_sekarang',
        'riwayat_penyakit_dahulu',
        'riwayat_penggunaan_obat',
        'riwayat_penyakit_keluarga',
        'status_lokalis',
        'diagnosa_kerja',
        'diagnosa_banding',
        'terapi',
        'dijelaskan_kepada',
        'ttd_penerima_info',
        'nama_dpjp',
        'ttd_dpjp',
        'isActive',

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
    public function kemoterapiPhysicalExaminationDetails()
    {
        return $this->hasMany(KemoterapiPhysicalExaminationDetail::class);
    }
    public function kemoterapiPlanDetails()
    {
        return $this->hasMany(KemoterapiPlanDetail::class);
    }
    public function kemoterapiEducationNeedDetails()
    {
        return $this->hasMany(KemoterapiEducationNeedDetail::class);
    }
    public function kemoterapiSupportingExaminationDetails()
    {
        return $this->hasMany(KemoterapiSupportingExaminationDetail::class);
    }

    public function kemoterapiKarnofskyStatusPerformances()
    {
        return $this->hasMany(KemoterapiKarnofskyStatusPerformance::class);
    }
}
