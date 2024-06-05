<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAdmPernyataanPersetujuanPatient extends Model
{
    use HasFactory;


    protected $fillable = [
        'surat_pernyataan_persetujuan_patient_id',
        'name',
    ];

    public function suratPernyataanPersetujuanPatient(){
        return $this->belongsTo(SuratPernyataanPersetujuanPatient::class);
    }
}
