<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorsSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'start_at',
        'ends_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
