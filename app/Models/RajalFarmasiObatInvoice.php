<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalFarmasiObatInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'rajal_farmasi_patient_id',
        'no_faktur',
        'grand_total',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function rajalFarmasiPatient(){
        return $this->belongsTo(RajalFarmasiPatient::class);
    }
    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
}
