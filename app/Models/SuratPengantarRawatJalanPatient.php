<?php

namespace App\Models;

use App\Helper\EncryptionHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantarRawatJalanPatient extends Model
{
    use HasFactory;
    protected  $fillable = [
        'queue_id',
        'patient_id',
        'user_id',
        'primer',
        'alat',
        'ruangan',
        'status',
        'tgl_operasi',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class,);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function operasiSuratPengantarRawatJalanPatient()
    {
        return $this->hasMany(OperasiSuratPengantarRawatJalanPatient::class);
    }
    public function sekunderSuratPengantarRawatJalanPatients()
    {
        return $this->hasMany(SekunderSuratPengantarRawatJalanPatient::class);
    }
    public function terapiSuratPengantarRawatJalanPatients()
    {
        return $this->hasMany(TerapiSuratPengantarRawatJalanPatient::class);
    }
    public function kebutuhanSuratPengantarRawatJalanPatients()
    {
        return $this->hasMany(KebutuhanSuratPengantarRawatJalanPatient::class);
    }
    public function rawatInapPatient()
    {
        return $this->hasOne(RawatInapPatient::class);
    }

    public function getPatientIdEncryptAttribute()
    {
        return EncryptionHelper::encrypt($this->patient_id);
    }

    public function getIdEncryptAttribute()
    {
        return EncryptionHelper::encrypt($this->id);
    }
}
