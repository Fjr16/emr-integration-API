<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalCpptSbarPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rme_cppt_id',
        'user_id',
        'tanggal',
        'ttd',
    ];

    public function rmeCppt() {
        return $this->belongsTo(RmeCppt::class);
    }
    public function user(){
        return $this->belongsTo(User::class); 
    }
}
