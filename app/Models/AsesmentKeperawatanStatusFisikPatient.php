<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentKeperawatanStatusFisikPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_keperawatan_patient_id'
    ];

    public function diagnosisKeperawatanPatient(){
        return $this->belongsTo(DiagnosisKeperawatanPatient::class);
    }

    public function statusFisikDiagnosaKeperawatanPatient(){
        return $this->hasOne(StatusFisikDiagnosaKeperawatanPatient::class);
    }

    public function psikoSosioSpritualDiagnosaKeperawatanPatient(){
        return $this->hasOne(PsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }

    public function ekonomiDiagnosaKeperawatanPatient(){
        return $this->hasOne(EkonomiDiagnosaKeperawatanPatient::class);
    }

    public function riwayatAlergiDiagnosaKeperawatanPatient(){
        return $this->hasMany(RiwayatAlergiDiagnosaKeperawatanPatient::class);
    }

    public function asesmentNyeriDiagnosaKeperawatanPatient(){
        return $this->hasOne(AsesmentNyeriDiagnosaKeperawatanPatient::class);
    }
}
