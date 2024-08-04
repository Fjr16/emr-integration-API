<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequest extends Model
{
    use HasFactory;
    protected $with = ['radiologiFormRequestDetails'];

    protected $fillable = [
        'user_id',  //dokter yang membuat permintaan
        'queue_id', 
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
    // dokter validator radiologi
    public function validator(){
        return $this->belongsTo(User::class, 'validator_rad_id');
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function radiologiFormRequestDetails(){
        return $this->hasMany(RadiologiFormRequestDetail::class);
    }
}
