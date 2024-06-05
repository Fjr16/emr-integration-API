<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpptRanap extends Model
{
    use HasFactory;
    protected $fillable = [
        'rawat_inap_patient_id',
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
        'serah_terima',
    ];

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ranapCpptSbarPatient()
    {
        return $this->hasOne(RanapCpptSbarPatient::class);
    }
    public function ranapCpptAlihRawatPatient()
    {
        return $this->hasOne(RanapCpptAlihRawatPatient::class);
    }
    public function ranapCpptSerahTerimaPatient()
    {
        return $this->hasOne(RanapCpptSerahTerimaPatient::class);
    }

    public function changeLogRanaps()
    {
        return $this->hasMany(ChangeLogCpptRanap::class, 'record_id')->where('record_type', self::class);
    }
}
