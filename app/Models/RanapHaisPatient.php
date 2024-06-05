<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapHaisPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'user_id',
        'room_detail_id',
        'jenis',
        'tanggal',
    ];

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomDetail()
    {
        return $this->belongsTo(RoomDetail::class);
    }

    public function ranapDetailHaisPatient()
    {
        return $this->hasMany(RanapHaisPatient::class);
    }
}
