<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'user_id', //dokter igd
        'status',
    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function igdGeneralConsents()
    {
        return $this->hasMany(IgdGeneralConsent::class);
    }
    public function igdTriages()
    {
        return $this->hasMany(IgdTriage::class);
    }
    public function igdAseKepPatient()
    {
        return $this->hasOne(IgdAseKepPatient::class);
    }
    public function igdRmeCppts()
    {
        return $this->hasOne(IgdRmeCppt::class);
    }
    public function suratPengantarRawatJalanPatients()
    {
        return $this->hasOne(SuratPengantarRawatJalanPatient::class);
    }
}
