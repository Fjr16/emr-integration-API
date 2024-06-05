<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiPhysicalExaminationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_initial_assesment_id',
        'name',
        'isNormal',
        'keterangan',
    ];

    public function kemoterapiInitialAssesment()
    {
        return $this->belongsTo(KemoterapiInitialAssesment::class);
    }
}
