<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticSecondary extends Model
{
    use HasFactory;

    protected $with = ['diagnostic'];
    protected $fillable = [
        'diagnostic_procedure_patient_id',
        'diagnostic_id',    //diagnosa sekunder
    ];

    public function diagnosticProcedurePatient(){
        return $this->belongsTo(DiagnosticProcedurePatient::class);
    }
    public function diagnostic(){
        return $this->belongsTo(Diagnostic::class);
    }
}
