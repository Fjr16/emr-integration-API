<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumPatientResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'patient_id',
        'user_id',
        'laboratorium_request_id',
        'nomor_antrian_lab',
        'nomor_reg_lab',
        'tanggal_periksa',
        'status',
        'kesan',
        'anjuran',
        'tgl_pengambilan_sampel',
        'tgl_pemeriksaan_selesai',
        'jam_pelaporan_kritis',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function laboratoriumUserValidator(){
        return $this->hasOne(LaboratoriumUserValidator::class);
    }
    public function laboratoriumRequest(){
        return $this->belongsTo(LaboratoriumRequest::class);
    }
    public function laboratoriumPatientResultDetails(){
        return $this->hasMany(LaboratoriumPatientResultDetail::class);
    }
    
}
