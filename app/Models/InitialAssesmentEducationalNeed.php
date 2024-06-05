<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialAssesmentEducationalNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_assesment_id',
        'name',
    ];

    public function initialAssesment(){
        return $this->belongsTo(InitialAssesment::class);
    }
}
