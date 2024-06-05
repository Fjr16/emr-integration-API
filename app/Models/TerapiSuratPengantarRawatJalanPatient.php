<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerapiSuratPengantarRawatJalanPatient extends Model
{
    use HasFactory;
    protected  $fillable = ['surat_pengantar_rawat_jalan_patient_id', 'name'];
}
