<?php

namespace App\Models\arg01;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatJalanPoliPatients extends Model
{
    use HasFactory;

    protected $table = 'rawat_jalan_poli_patients';

    protected $fillable = [
        'rawat_jalan_patient_id',
        'status',
        'status_rekam_medis'
    ];
}