<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'patient_id',
        'radiologi_form_request_id',
        'user_id',
        'tanggal_periksa',
        'no_antrian',
        'status',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function radiologiFormRequest(){
        return $this->belongsTo(RadiologiFormRequest::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function radiologiPatientRequestDetails(){
        return $this->hasMany(RadiologiPatientRequestDetail::class);
    }

}
