<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdEkonomiAssKepPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'igd_ase_kep_patient_id',
        'status',
        'hambatan',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
}
