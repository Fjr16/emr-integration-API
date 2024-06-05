<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdResikoNutrisionalAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_ase_kep_patient_id',
        'name',
        'category',
        'nilai',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
}
