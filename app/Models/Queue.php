<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;


    protected $with = ['rawatJalanPoliPatient'];

    protected $fillable = [
        'patient_id',
        'user_id',
        'status_antrian',
        'no_antrian',
        'tgl_antrian',
        'patient_category_id',
        'no_rujukan',
        'last_diagnostic',
        'category',
        'created_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function rajalGeneralConsent()
    {
        return $this->hasOne(RajalGeneralConsent::class);
    }

    public function patientCategory()
    {
        return $this->belongsTo(PatientCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctorPatient()
    {
        return $this->hasOne(DoctorPatient::class);
    }

    public function rawatJalanPoliPatient()
    {
        return $this->hasOne(RawatJalanPoliPatient::class);
    }

    //relasi ke daftar pasien radiologi
    public function radiologiFormRequests()
    {
        return $this->hasMany(RadiologiFormRequest::class);
    }
    public function laboratoriumRequests()
    {
        return $this->hasMany(LaboratoriumRequest::class);
    }
    public function permintaanLaboratoriumPatologiAnatomikPatient()
    {
        return $this->hasMany(PermintaanLaboratoriumPatologiAnatomikPatient::class);
    }
    public function suratBuktiPelayananPatients()
    {
        return $this->hasMany(SuratBuktiPelayananPatient::class);
    }

    public function diagnosisKeperawatanPatient()
    {
        return $this->hasMany(DiagnosisKeperawatanPatient::class);
    }
    public function suratKeteranganPatient()
    {
        return $this->hasOne(SuratKeteranganPatients::class);
    }


    public function diagnosisKeperawatanPatien()
    {
        return $this->hasOne(DiagnosisKeperawatanPatient::class);
    }
}
