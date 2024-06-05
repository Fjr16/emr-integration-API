<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrasiCatatanPerjalananKemoterapiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'catatan_perjalan_kemoterapi_patient_id', 
        'category', 
        'user_id'
    ];
}
