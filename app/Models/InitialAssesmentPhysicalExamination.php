<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialAssesmentPhysicalExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_assesment_id',
        'name',
        'isNormal',
        'keterangan',
    ];

    public function initialAssesment(){
        return $this->belongsTo(InitialAssesment::class);
    }

}
