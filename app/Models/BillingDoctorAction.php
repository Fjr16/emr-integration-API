<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDoctorAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_patient_id',
        'user_id',  //dokter
        'action_id',  //relasi ke tarif tindakan dan tindakan
        'patient_category_id',  //dokter
        'kode_dokter',
        'nama_dokter',
        'nama_poli',
        'kode_tindakan',
        'nama_tindakan',
        'jumlah',
        'tarif',
        'sub_total',
        'status',
    ];

     // dokter
    public function user(){
        return $this->belongsTo(User::class);
    }
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
