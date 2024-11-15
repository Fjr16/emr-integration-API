<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeLogCpptRanap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'record_id',
        'record_type',
        'old_data',
        'new_data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
