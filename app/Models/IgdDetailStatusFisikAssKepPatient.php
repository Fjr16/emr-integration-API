<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdDetailStatusFisikAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_status_fisik_ass_kep_patient_id',
        'category',
        'name',
    ];

    public function igdStatusFisikAssKepPatient(){
        return $this->belongsTo(IgdStatusFisikAssKepPatient::class);
    }
}
