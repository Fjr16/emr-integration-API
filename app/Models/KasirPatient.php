<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPatient extends Model
{
    use HasFactory;
    protected $with = ['billingDoctorConsultations', 'billingDoctorActions', 'billingRadiologies', 'billingLaboratories', 'billingOfMedicineFees'];
    protected $fillable = [
        'user_id',  //petugas kasir
        'queue_id',
        'total',
        'status',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    // new
    public function billingDoctorConsultations(){
        return $this->hasMany(BillingDoctorConsultation::class);
    }
    public function billingDoctorActions(){
        return $this->hasMany(BillingDoctorAction::class);
    }
    public function billingRadiologies(){
        return $this->hasMany(BillingRadiology::class);
    }
    public function billingLaboratories(){
        return $this->hasMany(BillingLaboratory::class);
    }
    public function billingOfMedicineFees(){
        return $this->hasMany(BillingOfMedicineFee::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
