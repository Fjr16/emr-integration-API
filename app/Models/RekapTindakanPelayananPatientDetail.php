<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapTindakanPelayananPatientDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_rekap_tindakan_pelayanan_patient_id',
        'tanggal',
        'lab',
        'action_members_id',
        'biaya_tindakan',
        'ecg',
        'tindakan',
        'user_id',
        'biaya_konsul',
        'pa',
        'oksigen',
        'lain',
    ];


    public function ranapRekapTindakanPelayananPatient(){
        return $this->belongsTo(RanapRekapTindakanPelayananPatient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function actionMembers(){
        return $this->belongsTo(ActionMembers::class);
    }
}
