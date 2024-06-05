<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraSedation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'tanggal_operasi',
        'dokter_anestesi',
        'dokter_bedah',
        'tanggal_pemeriksaan',
        'diagnosis',
        'rencana_operasi',
        'anamnesa',
        'is_konsumsi',
        'makan_terakhir',
        'minum_terakhir',
        'riwayat_alergi',
        'hasil_pemeriksaan_lain',
        'penyulit',
        'asa',
        'antisipasi',
        'is_can_operasi',
        'rencana_sedasi',
        'pasca_anestesi',
        'obat_analgesia',
        'ttd_dpjp_anestesi',
    ];

    public function rawatInapPatient(){
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ranapAssesmenPraSedationRiwayatDiseases(){
        return $this->hasMany(RanapAssesmenPraSedationRiwayatDisease::class);
    }
    public function ranapAssesmenPraSedationPemeriksaanPhysicals(){
        return $this->hasMany(RanapAssesmenPraSedationPemeriksaanPhysical::class);
    }
    public function ranapAssesmenPraSedationNafasEvaluations(){
        return $this->hasOne(RanapAssesmenPraSedationNafasEvaluation::class);
    }
    public function ranapAssesmenPraSedationOtherExaminations(){
        return $this->hasMany(RanapAssesmenPraSedationOtherExamination::class);
    }
    public function ranapAssesmenPraSedationNormalResults(){
        return $this->hasMany(RanapAssesmenPraSedationNormalResult::class);
    }
    public function ranapAssesmenPraSedationAnestesiPlans(){
        return $this->hasMany(RanapAssesmenPraSedationAnestesiPlan::class);
    }
    public function ranapAssesmenPraSedationAnestesiInstructions(){
        return $this->hasOne(RanapAssesmenPraSedationAnestesiInstruction::class);
    }
}
