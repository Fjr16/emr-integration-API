<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganPatients extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_bukti_pelayanan_patient_id',
        'queue_id',
        'patient_id',
        'diagnosa',
        'terapi',
        'tgl_surat_rujukan',
        'fasilitas_rujukan',
        'fasilitas_rujukan_lainnya',
        'tindak_lanjut',
        'tindak_lanjut_lainnya',
        'tgl_kunjungan',
        'nomor_antrian'
    ];


    public function suratBuktiPelayananPatient()
    {
        return $this->belongsTo(SuratBuktiPelayananPatient::class, 'surat_bukti_pelayanan_patient_id', 'id');
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class, 'queue_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
