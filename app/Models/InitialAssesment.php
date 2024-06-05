<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialAssesment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_jalan_poli_patient_id',
        'user_id',
        'patient_id',
        'isPasien',
        'name',
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
        'nm_dokter',
        'nm_pasien',
        'ttd_dokter',
        'ttd_pasien'
    ];

    public function rawatJalanPoliPatient(){
        return $this->belongsTo(RawatJalanPoliPatient::class);
    }
    public function initialAssesmentPhysicalExaminations(){
        return $this->hasMany(InitialAssesmentPhysicalExamination::class);
    }
    public function initialAssesmentSupportingExaminationResults(){
        return $this->hasMany(InitialAssesmentSupportingExaminationResult::class);
    }
    public function initialAssesmentPlan(){
        return $this->hasMany(InitialAsessmentPlan::class);
    }
    public function initialAssesmentEducationalNeeds(){
        return $this->hasMany(InitialAssesmentEducationalNeed::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
