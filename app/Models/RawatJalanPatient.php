<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatJalanPatient extends Model
{
    use HasFactory;

    protected $with = ['rawatJalanPoliPatient'];

    protected $fillable = [
        'queue_id',
        'patient_id',
    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function rawatJalanPoliPatient()
    {
        return $this->hasOne(RawatJalanPoliPatient::class);
    }
    public function rajalFarmasiPatient()
    {
        return $this->hasOne(RajalFarmasiPatient::class);
    }
    public function kasirPatient()
    {
        return $this->hasOne(KasirPatient::class);
    }

    public function rajalRoadPatients()
    {
        return $this->hasMany(RajalRoadPatient::class);
    }
    // general con
    public function rajalGeneralConsent()
    {
        return $this->hasOne(RajalGeneralConsent::class);
    }

}
