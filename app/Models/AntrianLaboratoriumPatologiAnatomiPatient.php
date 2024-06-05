<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianLaboratoriumPatologiAnatomiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'permintaan_laboratorium_patologi_anatomik_patient_id',
        'user_id',
        'tgl_diperiksa',
    ];

    public function permintaanLaboratoriumPatologiAnatomikPatient(){
        return $this->belongsTo(PermintaanLaboratoriumPatologiAnatomikPatient::class);
    }

    public function detailAntrianLaboratoriumPatologiAnatomiPatient(){
        return $this->hasMany(DetailAntrianLaboratoriumPatologiAnatomiPatient::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
