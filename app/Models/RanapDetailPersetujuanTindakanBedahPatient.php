<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailPersetujuanTindakanBedahPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_persetujuan_tindakan_bedah_patient_id',
        'jenis',
        'isi',
        'ttd',
    ];

    public function ranapPersetujuanTindakanBedahPatient(){
        return $this->belongsTo(RanapPersetujuanTindakanBedahPatient::class);
    }
}
