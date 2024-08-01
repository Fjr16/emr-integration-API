<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientActionReportDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_action_report_id',
        'action_id',        
        'jumlah',        
        'harga_satuan',        
        'sub_total',        
    ];

    public function action(){
        return $this->belongsTo(Action::class);
    }
    public function patientActionReport(){
        return $this->belongsTo(PatientActionReport::class);
    }

}
