<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiPatientRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiologi_patient_id',
        'radiologi_form_request_detail_id',
        'user_id',
        'nomor',
        'tanggal',
        'hasil',
        'image',
        'status',
    ];

    public function radiologiPatient(){
        return $this->belongsTo(RadiologiPatient::class);
    }
    public function radiologiFormRequestDetail(){
        return $this->belongsTo(RadiologiFormRequestDetail::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function changeLogs(){
        return $this->hasMany(ChangeLog::class, 'record_id')->where('record_type', self::class);
    }
}
