<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratBuktiPelayananPatientDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_bukti_pelayanan_patient_id',
        'diagnosa',
        'poliklinik',
        'tdt',
        'icd',
        'nama_tindakan',
    ];

    public function suratBuktiPelayananPatient()
    {
        return $this->belongsTo(SuratBuktiPelayananPatient::class);
    }
}
