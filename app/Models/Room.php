<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isActive',
    ];

    public function roomDetails()
    {
        return $this->hasMany(RoomDetail::class);
    }
    public function doctorSchedules()
    {
        return $this->hasMany(DoctorsSchedule::class);
    }
}
