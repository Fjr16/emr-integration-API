<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraAnesthesia extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'tanggal',
        'dokter_anestesi',
        'asisten_anestesi',
        'dokter_bedah',
        'diagnosis_pra_bedah',
        'jenis_pembedahan',
        'diagnosis_pasca_bedah',
        'jam_operasi',
        'puasa_jam',
        'status_fisik',
        'isAlergi',
        'penyulit_pra_anestesi',
        'ttd_dokter_anestesi',
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
    public function ranapAssesmenPraAnestesiChecklists(){
        return $this->hasMany(RanapAssesmenPraAnestesiChecklist::class);
    }
    public function ranapAssesmenPraAnestesiTechniques(){
        return $this->hasMany(RanapAssesmenPraAnestesiTechnique::class);
    }
    public function ranapAssesmenPraAnestesiSpecialTools(){
        return $this->hasMany(RanapAssesmenPraAnestesiSpecialTool::class);
    }
    public function ranapAssesmenPraAnestesiMonitorings(){
        return $this->hasMany(RanapAssesmenPraAnestesiMonitoring::class);
    }
    public function ranapAssesmenPraAnestesiInductions(){
        return $this->hasOne(RanapAssesmenPraAnestesiInduction::class);
    }
}
