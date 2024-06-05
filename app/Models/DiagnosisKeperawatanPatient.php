<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'no_rm',
        'patient_id',
        'queue_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    public function detailDiagnosisKeperawatanPatient()
    {
        return $this->hasMany(DetailDiagnosisKeperawatanPatient::class);
    }

    public function statusFisikDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(StatusFisikDiagnosaKeperawatanPatient::class);
    }

    public function psikoSosioSpritualDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(PsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }

    public function ekonomiDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(EkonomiDiagnosaKeperawatanPatient::class);
    }

    public function riwayatAlergiDiagnosaKeperawatanPatient()
    {
        return $this->hasMany(RiwayatAlergiDiagnosaKeperawatanPatient::class);
    }

    public function asesmentNyeriDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(AsesmentNyeriDiagnosaKeperawatanPatient::class);
    }

    public function resikoRajalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(ResikoRajalDiagnosaKeperawatanPatient::class);
    }

    public function asesmentStatusFungsionalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(AsesmentStatusFungsionalDiagnosaKeperawatanPatient::class);
    }

    public function risikoNutrisionalDiagnosaKeperawatanPatient()
    {
        return $this->hasOne(RisikoNutrisionalDiagnosaKeperawatanPatient::class);
    }

    public function detailMasalahDiagnosisKeperawatanPatient()
    {
        return $this->hasMany(DetailMasalahDiagnosisKeperawatanPatient::class);
    }

    public function detailRencanaDiagnosisKeperawatanPatient()
    {
        return $this->hasMany(DetailRencanaDiagnosisKeperawatanPatient::class);
    }
}
