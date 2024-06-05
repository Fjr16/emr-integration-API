<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratBuktiPelayananPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'patient_id',
        'nama_dokter',
        'tanggal',
        'jenis_kelamin',
        'berat',
        'tanggal_masuk',
        'jam_keluar',
        'keterangan',
        'anamnesa',
        'konsultasi',
        'usg',
        'tindakan',
        'rontgen',
        'diagnosis_utama',
        'icdx',
        'tindakan_utama',
        'icdg',
        'status',
        'ttd_dokter'

    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function suratBuktiPelayananPatientDetails()
    {
        return $this->hasMany(SuratBuktiPelayananPatientDetail::class);
    }
    public function suratBuktiPelayananSekunderDiagnosis()
    {
        return $this->hasMany(SuratBuktiPelayananSekunderDiagnosis::class);
    }
    public function suratBuktiPelayananSekunderActions()
    {
        return $this->hasMany(SuratBuktiPelayananSekunderAction::class);
    }

    public function suratKeteranganPatients()
    {
        return $this->hasOne(SuratKeteranganPatients::class);
    }
}
