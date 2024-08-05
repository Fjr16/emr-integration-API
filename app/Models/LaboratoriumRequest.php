<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  //dokter yang membuat permintaan
        'queue_id',
        'diagnosa',
        'catatan',
        'ttd_dokter',
        'tipe_permintaan',
        'tanggal_sampel',
        'jadwal_periksa',
        'tanggal_periksa_selesai',
        'no_reg',
        'status',
        'validator_id',
        'petugas_id',
        'kesan_anjuran',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function validator(){
        return $this->belongsTo(User::class, 'validator_id');
    }
    public function petugas(){
        return $this->belongsTo(User::class, 'petugas_id');
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function laboratoriumRequestDetails(){
        return $this->hasMany(LaboratoriumRequestDetail::class);
    }
}
