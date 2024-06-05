<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionMemberRates extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_members_id',
        'patient_category_id',
        'tarif_umum',
        'tarif_uc',
        'jasa_dokter'
    ];

    public function actionMember(){
        return $this->belongsTo(ActionMembers::class);
    }

    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
}
