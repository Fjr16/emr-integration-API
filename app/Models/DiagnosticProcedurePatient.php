<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticProcedurePatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'diagnostic_id',    //diagnosa primer
        'desc_diagnosa_primer',
        'desc_diagnosa_sekunder',
        'procedure_id',
        'desc_prosedure',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function diagnostic(){
        return $this->belongsTo(Diagnostic::class);
    }
    public function procedure(){
        return $this->belongsTo(Procedure::class);
    }
    public function diagnosticSecondary(){
        return $this->hasMany(DiagnosticSecondary::class);
    }
}
