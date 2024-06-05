<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapFormRekonsiliasiMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'isAlergi',
        'isInUseMedicine',
        'intruksi',
        'nama_dokter',
        'ttd_dokter',
        'nama_apoteker',
        'ttd_apoteker',
        'tanggal',
    ];

    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function ranapFormRekonsiliasiDetailMedicines(){
        return $this->hasMany(RanapFormRekonsiliasiDetailMedicine::class);
    }
}
