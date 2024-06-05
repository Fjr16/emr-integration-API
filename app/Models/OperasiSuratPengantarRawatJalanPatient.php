<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperasiSuratPengantarRawatJalanPatient extends Model
{
    use HasFactory;
    protected  $fillable = ['surat_pengantar_rawat_jalan_patient_id', 'name'];

    public function suratPengantarRawatJalanPatient(){
        return $this->belongsTo(SuratPengantarRawatJalanPatient::class);
    }
}
