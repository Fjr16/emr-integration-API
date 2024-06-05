<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdRiwayatAlergiAssKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_ase_kep_patient_id',
        'status',
        'alergi_obat',
        'reaksi_obat',
        'alergi_mkn',
        'reaksi_mkn',
        'alergi_lainnya',
        'reaksi_lainnya',
    ];

    public function igdAseKepPatient(){
        return $this->belongsTo(IgdAseKepPatient::class);
    }
}
