<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarTilikVerifikasiPraOperasiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'jam_tiba',
        'jam_keluar',
        'ruang_rawat',
        'tanggal_operasi',
        'tindakan_operasi',
        'lokasi_sisi_operasi_tindakan',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class,);
    }

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class,);
    }
}
