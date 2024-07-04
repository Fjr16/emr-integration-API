<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatJalanPoliPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'status',
    ];
    
    public function queue(){
        return $this->belongsTo(Queue::class);
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
