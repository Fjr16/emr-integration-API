<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRencanaDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
        protected $fillable = [
            'diagnosa',
            'diagnosis_keperawatan_patient_id',
        ];

        public function diagnosisKeperawatanPatient(){
            return $this->belongsTo(DiagnosisKeperawatanPatient::class);
        }
}
