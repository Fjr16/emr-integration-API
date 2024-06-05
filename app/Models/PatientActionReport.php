<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientActionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'laporan_tindakan',
        'intruksi',
        'diagnosa',
        'tgl_tindakan',
        'lokasi',
        'rawat_jalan_poli_patient_id',
        'jenis_tindakan',
        'paraf'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function action_members(){
        return $this->belongsToMany(ActionMembers::class, 'patient_action_report_details');
    }
    public function rawatJalanPoliPatient(){
        return $this->belongsTo(RawatJalanPoliPatient::class);
    }
}
