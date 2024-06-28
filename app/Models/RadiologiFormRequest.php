<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  //dokter yang membuat permintaan
        'queue_id', 
        'patient_id', 
        'room_detail_id',
        'diagnosa_klinis',
        'catatan',
        'ttd_dokter',
        'jadwal_periksa',
        'no_reg_rad',
        'status',
        'validator_rad_id',  //dokter yang validasi relasi ke user
    ];

    // Dokter yang membuat permintaan
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function validator(){
        return $this->belongsTo(User::class, 'validator_rad_id');
    }
    
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function roomDetail(){
        return $this->belongsTo(RoomDetail::class);
    }
    public function radiologiFormRequestDetails(){
        return $this->hasMany(RadiologiFormRequestDetail::class);
    }
}
