<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdRencanaAsuhanAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_ase_kep_patient_id',
        'name',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
}
