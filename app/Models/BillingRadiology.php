<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingRadiology extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_patient_id',
        'action_id',  //relasi ke tarif tindakan dan tindakan
        'patient_category_id',  //tanggungan
        'kode_tindakan',
        'nama_tindakan',
        'jumlah',
        'tarif',
        'sub_total',
    ];

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
    public function actionRate(){
        return $this->belongsTo(ActionRate::class);
    }
    public function kasirPatient(){
        return $this->belongsTo(KasirPatient::class);
    }
}
