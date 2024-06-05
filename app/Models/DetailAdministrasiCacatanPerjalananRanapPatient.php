<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAdministrasiCacatanPerjalananRanapPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'administrasi_cacatan_perjalanan_ranap_patient_id',
        'name',
        'value'
    ];

    public function administrasiCacatanPerjalananRanapPatient(){
        return $this->hasMany(AdministrasiCacatanPerjalananRanapPatient::class);
    }


}
