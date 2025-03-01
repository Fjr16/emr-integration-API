<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;


    protected $with = [
        'rawatJalanPoliPatient', 
        'doctorInitialAssesment',
        'soapDokter',
    ];

    protected $fillable = [
        'patient_id',
        'user_id',
        'dokter_id',
        'status_antrian',
        'no_antrian',
        'tgl_antrian',
        'patient_category_id',
        'no_rujukan',
        'last_diagnostic',
        'created_at',
        'ttd_verif',
        'stts_satu_sehat'
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
    public function dpjp()
    {
        return $this->belongsTo(User::class, 'dokter_id');
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
    // new data
    public function perawatInitialAssesment()
    {
        return $this->hasOne(PerawatInitialAsesment::class);
    }
    public function doctorInitialAssesment()
    {
        return $this->hasOne(DoctorInitialAsessment::class);
    }
    public function diagnosticProcedurePatient()
    {
        return $this->hasOne(diagnosticProcedurePatient::class);
    }
    public function medicineReceipt()
    {
        return $this->hasOne(MedicineReceipt::class);
    }
    public function soapDokter()
    {
        return $this->hasOne(RmeCppt::class);
    }
    public function patientActionReport()
    {
        return $this->hasOne(PatientActionReport::class);
    }
    public function planControlPatient()
    {
        return $this->hasOne(PlanControlPatient::class);
    }
    public function konsulInternal()
    {
        return $this->hasOne(KonsulInternal::class);
    }
    // farmasi patient
    public function rajalFarmasiPatient() {
        return $this->hasOne(RajalFarmasiPatient::class);
    }
    // billing patient
    public function kasirPatient() {
        return $this->hasOne(KasirPatient::class);
    }
    // data satu sehat
    public function satuSehatPatients() {
        return $this->hasMany(SatuSehatPatient::class);
    }
}
