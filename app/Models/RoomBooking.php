<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'bed_id',
        'tanggal_masuk',
        'tanggal_selesai',
        'status',
    ];
}
