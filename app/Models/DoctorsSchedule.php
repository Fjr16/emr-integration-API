<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorsSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_poli_id',
        'day',
        'start_at',
        'ends_at',
    ];

    public function doctorPoli(){
        return $this->belongsTo(DoctorPoli::class);
    }
}
