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
        // verifikasi kesiapan data
        'receipts_ready',
        'actions_ready',
        'radiologies_ready',
        'laboratories_ready',
    ];
    
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
}
