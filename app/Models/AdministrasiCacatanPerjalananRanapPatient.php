<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrasiCacatanPerjalananRanapPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'catatan_perjalan_ranap_patient_id', 
        'category', 
        'user_id'
    ];
}
