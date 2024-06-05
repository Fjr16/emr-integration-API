<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiRegimen extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_prekemo_id',
        'kemoterapi_intrakemo_id',
        'kemoterapi_postkemo_id',
        'jam_mulai',
        'name',
        'keterangan',
        'jam_selesai',
    ];

    public function kemoterapiPrekemo()
    {
        return $this->belongsTo(KemoterapiPrekemo::class);
    }
    public function kemoterapiIntrakemo()
    {
        return $this->belongsTo(KemoterapiIntrakemo::class);
    }
    public function kemoterapiPostkemo()
    {
        return $this->belongsTo(KemoterapiPostkemo::class);
    }
}
