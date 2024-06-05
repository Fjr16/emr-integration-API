<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdAseKepPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_patient_id',
        'patient_id',
        'user_id',
        'ttdDokter',
        'nm_dokter',
        'ttdPerawat',
        'nm_perawat',
        'tgl_selesai_asesmen',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function igdPatient(){
        return $this->belongsTo(IgdPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    // detail Status Fisik
    public function igdStatusFisikAssKepPatient(){
        return $this->hasOne(IgdStatusFisikAssKepPatient::class);
    }
    public function igdPsikoSpiritualAssKepPatients(){
        return $this->hasMany(IgdPsikoSpiritualAssKepPatient::class);
    }
    public function igdEkonomiAssKepPatient(){
        return $this->hasOne(IgdEkonomiAssKepPatient::class);
    }
    public function igdRiwayatAlergiAssKepPatient(){
        return $this->hasOne(IgdRiwayatAlergiAssKepPatient::class);
    }
    public function igdAsesmenNyeriAssKepPatient(){
        return $this->hasOne(IgdAsesmenNyeriAssKepPatient::class);
    }

    // Skrining Resiko Jatuh
    public function igdSkriningResikoAssKepPatient(){
        return $this->hasOne(IgdSkriningResikoAssKepPatient::class);
    }
    public function igdStatusFungsionalAssKepPatients(){
        return $this->hasMany(IgdStatusFungsionalAssKepPatient::class);
    }
    public function igdResikoNutrisionalAssKepPatients(){
        return $this->hasMany(IgdResikoNutrisionalAssKepPatient::class);
    }

    // diagnosis keperawatan
    public function igdDiagnosisKeperawatanAssKepPatients(){
        return $this->hasMany(IgdDiagnosisKeperawatanAssKepPatient::class);
    }

    public function igdMasalahKeperawatanAssKepPatients(){
        return $this->hasMany(IgdMasalahKeperawatanAssKepPatient::class);
    }

    // Rencana Asuhan
    public function igdRencanaAsuhanAssKepPatients(){
        return $this->hasMany(IgdRencanaAsuhanAssKepPatient::class);
    }

}
