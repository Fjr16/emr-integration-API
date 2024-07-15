<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatJalanPoliPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'diet',
        'intruksi',
        'cara_keluar',
        'keadaan_keluar',
        'status',
    ];
    
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
}
