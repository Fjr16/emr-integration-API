<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorInitialAsessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'queue_id',
        'patient_id',
        'user_id',
        'keluhan_utama',
        'keadaan_umum',
        'kesadaran',
        'tb',
        'bb',
        'nadi',
        'td_sistolik',
        'td_diastolik',
        'suhu',
        'nafas',
        'ttd',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
