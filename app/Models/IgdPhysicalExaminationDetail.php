<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdPhysicalExaminationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_initial_assesment_id',
        'name',
        'isNormal',
        'keterangan',
    ];

    public function igdInitialAssesment(){
        return $this->belongsTo(IgdInitialAssesment::class);
    }
}
