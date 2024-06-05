<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'isActive',
        'kode_dokter_poli',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function doctorSchedules()
    {
        return $this->hasMany(DoctorsSchedule::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function hais()
    {
        return $this->hasMany(RanapHaisPatient::class);
    }
    public function ranapMppPatients()
    {
        return $this->hasMany(RanapMppPatient::class);
    }
}
