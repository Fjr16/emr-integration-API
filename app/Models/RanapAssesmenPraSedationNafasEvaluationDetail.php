<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraSedationNafasEvaluationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'ranap_assesmen_pra_sedation_nafas_evaluation_id',
        'keterangan',
    ];
}
