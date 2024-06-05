<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiPlanDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_initial_assesment_id',
        'name'
    ];
    public function kemoterapiInitialAssesment()
    {
        return $this->belongsTo(KemoterapiInitialAssesment::class);
    }
}
