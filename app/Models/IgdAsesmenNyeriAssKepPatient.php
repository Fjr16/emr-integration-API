<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdAsesmenNyeriAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_ase_kep_patient_id',
        'status',
        'category',
        'provocation',
        'quality',
        'region',
        'severity',
        'time',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
    public function igdDetailAsesmenNyeriAssKepPatients(){
        return $this->hasMany(IgdDetailAsesmenNyeriAssKepPatient::class);
    }
}
