<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapCpptAlihRawatPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'cppt_ranap_id',
        'user_id',
        'ttd_user',
        'tanggal',
    ];


    public function cpptRanap()
    {
        return $this->belongsTo(CpptRanap::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
