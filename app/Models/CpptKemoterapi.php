<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpptKemoterapi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_patient_id',
        'user_id',
        'patient_id',
        'soap',
        'intruksi',
        'tanggal',
        'tipe_cppt',
        'ttd_user',
        'tanggal_dpjp',
        'ttd_dpjp',
        'id_dpjp',
    ];

    public function kemoterapiPatient()
    {
        return $this->belongsTo(KemoterapiPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kemoterapiCpptSbarPatient()
    {
        return $this->hasOne(KemoterapiCpptSbarPatient::class);
    }
    // public function ranapCpptAlihRawatPatient()
    // {
    //     return $this->hasOne(RanapCpptAlihRawatPatient::class);
    // }

    public function changeLogKemoterapi()
    {
        return $this->hasMany(ChangeLogCpptKemoterapi::class, 'record_id')->where('record_type', self::class);
    }
}
