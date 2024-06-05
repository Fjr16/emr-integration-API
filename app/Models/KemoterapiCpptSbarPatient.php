<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiCpptSbarPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'cppt_ranap_id',
        'user_id',
        'tanggal',
        'ttd',
    ];

    public function cpptKemoterapi()
    {
        return $this->belongsTo(CpptKemoterapi::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
