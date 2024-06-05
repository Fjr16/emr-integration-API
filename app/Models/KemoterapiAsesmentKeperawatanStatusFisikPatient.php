<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiAsesmentKeperawatanStatusFisikPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_diagnosis_keperawatan_patient_id'
    ];

    public function kemoterapidiagnosisKeperawatanPatient(){
        return $this->belongsTo(KemoterapiDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapistatusFisikDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiStatusFisikDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapipsikoSosioSpritualDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiPsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiekonomiDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiEkonomiDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiriwayatAlergiDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiRiwayatAlergiDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapiasesmentNyeriDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiAsesmentNyeriDiagnosaKeperawatanPatient::class);
    }
}
