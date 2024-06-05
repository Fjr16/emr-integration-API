<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'deskripsi',
    ];

    public function detailTindakan(){
        return $this->hasMany(DetailTindakanIcd::class);
    }
}
