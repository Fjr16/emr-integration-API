<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmeCppt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'soap',
        'intruksi',
        'tanggal',
        'rawat_jalan_poli_patient_id',
        'ttd_user',
        'ttd_dpjp',
        'tanggal_dpjp',
        'serah_terima',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function changeLogs(){
        return $this->hasMany(ChangeLog::class, 'record_id')->where('record_type', self::class);
    }

    public function rawatJalanPoliPatient(){
        return $this->belongsTo(RawatJalanPoliPatient::class);
    }

    // include cppt
    public function rajalCpptSbarPatient(){
        return $this->hasOne(RajalCpptSbarPatient::class);
    }
    public function rajalCpptSerahTerimaPatient(){
        return $this->hasOne(RajalCpptSerahTerimaPatient::class);
    }
}
