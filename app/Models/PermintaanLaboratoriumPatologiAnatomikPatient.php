<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanLaboratoriumPatologiAnatomikPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'queue_id',
        'user_id',
        'patient_id',
        'no_sediaan',
        'jaringanTubuhDiDapat',
        'lokasiJaringanYangDiAmbil',
        'pengobatanYangTelahDiBerikan',
        'diagnosisKlinik',
        'keteranganKlinik',
        'gambarLokasiMuka',
        'gambarLokasiLeher',
        'gambarLokasiDada',
        'sketsaLokasi',
        'hphjt',
        'catatan'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function queue(){
        return $this->belongsTo(Queue::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function antrianLaboratoriumPatologiAnatomiPatient(){
        return $this->hasOne(AntrianLaboratoriumPatologiAnatomiPatient::class);
    }
}
