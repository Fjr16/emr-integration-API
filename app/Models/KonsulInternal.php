<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsulInternal extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'user_id',  //dokter yang meminta konsul
        'dokter_konsul_id',
        'permintaan_konsul',
        'jawaban_konsul',
        'ttd_user',
        'ttd_dokter_konsul',
        'status',
    ];

    public function queue() {
        return $this->belongsTo(Queue::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function dokterKonsul() {
        return $this->belongsTo(User::class, 'dokter_konsul_id');
    }
}
