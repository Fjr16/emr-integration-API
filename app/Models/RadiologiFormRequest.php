<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'queue_id', 
        'patient_id', 
        'room_detail_id',
        'diagnosa_klinis',
        'catatan',
        'ttd_dokter'
    ];

    public function user(){
        return $this->belongsTo(User::class);
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

    //relasi ke daftar pasien radiologi
    public function radiologiPatient(){
        return $this->hasOne(RadiologiPatient::class);
    }
}
