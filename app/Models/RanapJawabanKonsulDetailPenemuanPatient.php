<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapJawabanKonsulDetailPenemuanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_jawaban_konsul_penyakit_dalam_patient_id',
        'name',
        'value',
        'satuan',
    ];


    public function ranapJawabanKonsulPenyakitDalamPatient(){
        return $this->belongsTo(RanapJawabanKonsulPenyakitDalamPatient::class);
    }
}
