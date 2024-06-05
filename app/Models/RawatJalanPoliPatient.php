<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatJalanPoliPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_jalan_patient_id',
        'status',
        'status_rekam_medis'
    ];
    
    public function rawatJalanPatient(){
        return $this->belongsTo(RawatJalanPatient::class);
    }

    public function initialAssesments(){
        return $this->hasMany(InitialAssesment::class);
    }
    public function rmeCppts(){
        return $this->hasMany(RmeCppt::class);
    }
    public function prmrjs(){
        return $this->hasMany(Prmrj::class);
    }
    public function patientActionReports(){
        return $this->hasMany(PatientActionReport::class);
    }
    public function medicineReceipts(){
        return $this->hasMany(MedicineReceipt::class);
    }
}
