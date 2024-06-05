<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_id',
        'billing_caption_id',
        'name',
        'code_icd',
        'tarif_umum',
        'tarif_uc',
        'tanggungan',
    ];

    //kelompok tindakan
    public function action(){
        return $this->belongsTo(Action::class);
    }

    public function billingCaption(){
        return $this->belongsTo(BillingCaption::class);
    }

    public function actionMemberRates(){
        return $this->hasMany(ActionMemberRates::class);
    }

    public function patientActionReports(){
        return $this->belongsToMany(PatientActionReport::class, 'patient_action_report_details');
    }
}
