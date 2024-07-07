<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmeCppt extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'patient_id',
        'user_id',
        'subjective',
        'objective',
        'asesment',
        'planning',
        'ttd_user',
        'ttd_dpjp',
        'tanggal_verif_dpjp',
        'category_soap',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
}
