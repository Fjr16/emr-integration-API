<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdDetailAsesmenNyeriAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_asesmen_nyeri_ass_kep_patient_id',
        'name',
    ];

    public function igdAsesmenNyeriAssKepPatient(){
        return $this->belongsTo(IgdAsesmenNyeriAssKepPatient::class);
    }
}
