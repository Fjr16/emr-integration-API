<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatInitialAsesmentPsychology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function perawatInitialAssesment() {
        return $this->belongsTo(PerawatInitialAsesment::class);
    }
}
