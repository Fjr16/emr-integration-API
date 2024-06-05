<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailEdukasiPraAnestesiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_edukasi_pra_anestesi_patient_id',
        'name'
    ];

    public function ranapEdukasiPraAnestesiPatient(){
        return $this->belongsTo(RanapEdukasiPraAnestesiPatient::class);
    }
}
