<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'user_id', //dokter yang membuat permintaan kemo, yang akan menjadi dpjp kemo
        'tanggal_periksa',
        'status',
    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kemoterapiGeneralConsents()
    {
        return $this->hasMany(KemoterapiGeneralConsent::class);
    }
    public function kemoterapiTindakanPelayananPatients()
    {
        return $this->hasMany(KemoterapiTindakanPelayananPatient::class);
    }
    public function kemoterapiDpjpPatientDetails()
    {
        return $this->hasMany(KemoterapiDpjpPatientDetail::class);
    }
    public function cpptKemoterapi()
    {
        return $this->hasMany(CpptKemoterapi::class);
    }
}
