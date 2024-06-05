<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiSbpkPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'patient_id',
        'tanggal_masuk',
        'jenis_kelamin',
        'keterangan',
        'anamnesa',
        'diagnosis_utama',
        'icdx',
        'tindakan_utama',
        'icdg',
        'status',
        'nama_dpjp',
        'ttd_dpjp'
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function kemoterapiSbpkPatientDetails(){
        return $this->hasMany(KemoterapiSbpkPatientDetail::class);
    }
    public function kemoterapiSbpkSekunderDiagnosis(){
        return $this->hasMany(KemoterapiSbpkSekunderDiagnosis::class);
    }
    public function kemoterapiSbpkSekunderAction(){
        return $this->hasMany(KemoterapiSbpkSekunderAction::class);
    }
}
