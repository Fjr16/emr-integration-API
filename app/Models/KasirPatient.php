<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rawat_jalan_patient_id',
        'total',
        'status',
    ];

    public function rawatJalanPatient(){
        return $this->belongsTo(RawatJalanPatient::class);
    }

    public function detailKasirPatients(){
        return $this->hasMany(DetailKasirPatient::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
