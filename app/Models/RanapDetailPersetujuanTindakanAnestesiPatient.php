<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapDetailPersetujuanTindakanAnestesiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_persetujuan_tindakan_anestesi_patient_id',
        'jenis',
        'isi',
        'ttd',
    ];

    public function ranapPersetujuanTindakanAnestesiPatient(){
        return $this->belongsTo(RanapPersetujuanTindakanAnestesiPatient::class);
    }
}
