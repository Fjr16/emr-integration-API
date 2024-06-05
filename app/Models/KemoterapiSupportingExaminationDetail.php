<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiSupportingExaminationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_initial_assesment_id',
        'name',
        'hasil'
    ];

    public function kemoterapiInitialAssesment()
    {
        return $this->belongsTo(KemoterapiInitialAssesment::class);
    }
}
