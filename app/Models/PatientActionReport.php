<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientActionReport extends Model
{
    use HasFactory;

    protected $with = ['patientActionReportDetails'];

    protected $fillable = [
        'user_id',
        'queue_id',
        'tgl_tindakan',
        'laporan_tindakan',
        'ttd',  //ttd dokter
    ];

    // dokter
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }

    public function patientActionReportDetails(){
        return $this->hasMany(PatientActionReportDetail::class);
    }
}
