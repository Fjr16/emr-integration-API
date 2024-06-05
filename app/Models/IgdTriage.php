<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdTriage extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'tanggal_masuk',
        'jam_respon',
        'jalan_nafas',
        'pernapasan',
        'sirkulasi',
        'disabilitas',
        'lain',
        'cara_masuk',
        'asal_masuk',
        'jenis_kasus',
        'igd_patient_id',
    ];

    public function igdTriageCheckups(){
        return $this->belongsToMany(IgdTriageCheckup::class, 'igd_triage_details');
    }
    public function igdTriageDoa(){
        return $this->hasOne(IgdTriageDoa::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function igdPatient(){
        return $this->belongsTo(IgdPatient::class);
    }
   

}
