<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKasirPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_patient_id',
        'name',
        'tanggal',
        'category',
        'jumlah',
        'tarif',
    ];

    public function kasirPatient(){
        return $this->belongsTo(KasirPatient::class);
    }
}
