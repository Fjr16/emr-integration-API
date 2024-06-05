<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAdministrasiCatatanPerjalananKemoterapiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'administrasi_cacatan_perjalanan_kemoterapi_patient_id',
        'name',
        'value'
    ];

    public function administrasiCacatanPerjalananRanapPatient(){
        return $this->hasMany(AdministrasiCatatanPerjalananKemoterapiPatient::class);
    }

}
