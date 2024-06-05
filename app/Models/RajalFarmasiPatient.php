<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalFarmasiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_jalan_patient_id',
        'status',
    ];

    public function rawatJalanPatient(){
        return $this->belongsTo(RawatJalanPatient::class);
    }
    public function rajalFarmasiObatInvoices(){
        return $this->hasMany(RajalFarmasiObatInvoice::class);
    }
}
