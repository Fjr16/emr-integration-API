<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalFarmasiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'queue_id',
        'patient_id',
        'no_resep',
        'status',
        'grand_total',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
}
