<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialAssesmentSupportingExaminationResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_assesment_id',
        'name',
        'keterangan',
    ];

    public function initialAssesment(){
        return $this->belongsTo(InitialAssesment::class);
    }
}
