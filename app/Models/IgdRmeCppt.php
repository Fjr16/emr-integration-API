<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdRmeCppt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'soap',
        'intruksi',
        'tanggal',
        'igd_patient_id',
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
    public function igdPatient(){
        return $this->belongsTo(IgdPatient::class);
    }
}
