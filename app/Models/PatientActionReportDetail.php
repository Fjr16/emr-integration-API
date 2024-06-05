<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientActionReportDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_action_report_id',
        'action_members_id',        
    ];

    public function actionMembers(){
        return $this->belongsTo(ActionMembers::class);
    }

}
