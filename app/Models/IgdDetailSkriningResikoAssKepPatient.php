<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdDetailSkriningResikoAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_skrining_resiko_ass_kep_patient_id',
        'name',
    ];

    public function igdSkriningResikoAssKepPatient(){
        return $this->belongsTo(IgdSkriningResikoAssKepPatient::class);
    }
}
