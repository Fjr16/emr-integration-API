<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratBuktiPelayananSekunderDiagnosis extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_bukti_pelayanan_patient_id',
        'diganosa_name',
        'diagnosa_icdx',
    ];

    public function suratBuktiPelayananPatient()
    {
        return $this->belongsTo(SuratBuktiPelayananPatient::class);
    }
}
