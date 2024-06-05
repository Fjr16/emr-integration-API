<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdTriageDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_triage_id',
        'igd_triage_checkup_id',
    ];
}
