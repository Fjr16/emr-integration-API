<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prmrj extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'diagnosa_penting',
        'uraian_klinis',
        'rencana_penting',
        'tanggal',
        'rawat_jalan_poli_patient_id',
        'paraf',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function rawatJalanPoliPatient(){
        return $this->belongsTo(RawatJalanPoliPatient::class);
    }
}
