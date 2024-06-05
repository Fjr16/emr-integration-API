<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdStatusFisikAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_ase_kep_patient_id',
        'darah',
        'nadi',
        'suhu',
        'pernafasan',
        'tb',
        'bb',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
    public function igdDetailStatusFisikAssKepPatients(){
        return $this->hasMany(IgdDetailStatusFisikAssKepPatient::class);
    }
}
