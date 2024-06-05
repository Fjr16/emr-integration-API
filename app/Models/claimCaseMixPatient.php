<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class claimCaseMixPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'queue_id',
        'patient_id',
        'admission_id',
        'hospital_admission_id',
        'nomor_sep',
        'nomor_rm',
        'nama_pasien',
        'tgl_lahir',
        'gender',
        'admission_id',
        'hospital_admission_id',
        'nomor_kartu'
    ];

    public function queue() {
        return $this->belongsTo(Queue::class);
    }
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
