<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'queue_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
}
