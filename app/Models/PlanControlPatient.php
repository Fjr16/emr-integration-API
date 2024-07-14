<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanControlPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'user_id',
        'tgl_kontrol',
        'ttd',
        'status',
    ];

    public function queue() {
        return $this->belongsTo(Queue::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
