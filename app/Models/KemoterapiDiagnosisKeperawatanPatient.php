<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'no_rm',
        'patient_id',
        'queue_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    
    public function kemoterapidetailDiagnosisKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailDiagnosisKeperawatanPatient::class);
    }

    public function kemoterapistatusFisikDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiStatusFisikDiagnosaKeperawatanPatient::class);
    }

    public function kemoterapipsikoSosioSpritualDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiPsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapiekonomiDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiEkonomiDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapiriwayatAlergiDiagnosaKeperawatanPatient(){
        return $this->hasMany(KemoterapiRiwayatAlergiDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapiasesmentNyeriDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiAsesmentNyeriDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapiresikoRajalDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiResikoRajalDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapiasesmentStatusFungsionalDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiAsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapirisikoNutrisionalDiagnosaKeperawatanPatient(){
        return $this->hasOne(KemoterapiRisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }
    
    public function kemoterapidetailMasalahDiagnosisKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailMasalahDiagnosisKeperawatan::class);
    }
    
    public function kemoterapidetailRencanaDiagnosisKeperawatanPatient(){
        return $this->hasMany(KemoterapiDetailRencanaDiagnosisKeperawatanPatient::class);
    }
}
