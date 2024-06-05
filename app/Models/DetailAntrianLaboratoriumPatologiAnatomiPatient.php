<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAntrianLaboratoriumPatologiAnatomiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'antrian_laboratorium_patologi_anatomi_patient_id',
        'name',
        'status',
    ];

    public function antrianLaboratoriumPatologiAnatomiPatient(){
        return $this->belongsTo(AntrianLaboratoriumPatologiAnatomiPatient::class);
    }
    
    public function hasilHistopatologiPatient(){
        return $this->hasOne(HasilHistopatologiPatient::class);
    }

    public function hasilSitopatologiPatient(){
        return $this->hasOne(HasilSitopatologiPatient::class);
    }
}
