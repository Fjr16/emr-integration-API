<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPoli extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poliklinik_id',
        'tarif',
        'isActive',
    ];

    public function poli(){
        return $this->belongsTo(Poliklinik::class, 'poliklinik_id');
    }
    public function user(){ //dokter
        return $this->belongsTo(User::class);
    }
    public function doctorSchedules(){ //jadwal dokter
        return $this->hasMany(DoctorsSchedule::class);
    }
}
