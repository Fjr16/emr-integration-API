<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdInitialAssesment extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_patient_id',
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

    public function igdPatient(){
        return $this->belongsTo(IgdPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function igdPhysicalExaminationDetails(){
        return $this->hasMany(IgdPhysicalExaminationDetail::class);
    }
    public function igdPlanDetails(){
        return $this->hasMany(IgdPlanDetail::class);
    }
    public function igdEducationNeedDetails(){
        return $this->hasMany(IgdEducationNeedDetail::class);
    }
    public function igdStatusPresentDetails(){
        return $this->hasMany(IgdStatusPresentDetail::class);
    }
    public function igdSupportingExaminationDetails(){
        return $this->hasMany(IgdSupportingExaminationDetail::class);
    }
    
}
