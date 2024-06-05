<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilHistopatologiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'detail_antrian_laboratorium_patologi_anatomi_patient_id',
        'user_id',
        'no_pend',
        'pemeriksaan',
        'makroskopik',
        'mikroskopik',
        'diagnosis',
        'kesan',
        'dokterpa',
    ];

    public function detailAntrianLaboratoriumPatologiAnatomiPatient(){
        return $this->belongsTo(DetailAntrianLaboratoriumPatologiAnatomiPatient::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
