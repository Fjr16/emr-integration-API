<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdSkriningResikoAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_ase_kep_patient_id',
        'a',
        'b',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
    public function igdDetailSkriningResikoAssKepPatients(){
        return $this->hasMany(IgdDetailSkriningResikoAssKepPatient::class);
    }
}
