<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'action_id',
        'patient_category_id',
        'tarif',
    ];

    public function action(){
        return $this->belongsTo(Action::class);
    }

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
}
