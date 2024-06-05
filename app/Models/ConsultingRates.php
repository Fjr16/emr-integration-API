<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultingRates extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'patient_category_id',
        'tindakan',
        'pembayaran',
    ];

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
}
