<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatInapPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'queue_id',
        'surat_pengantar_rawat_jalan_patient_id',
        // 'user_id',
        'status',
        'mulai',
        'selesai',
        'bed_id',
    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function ranapDpjpPatientDetails()
    {
        return $this->hasMany(RanapDpjpPatientDetail::class);
    }

    public function skriningCovidRanapPatient()
    {
        return $this->hasOne(SkriningCovidRanapPatient::class);
    }

    public function catatanPerjalanRanapPatient()
    {
        return $this->hasOne(CatatanPerjalanRanapPatient::class);
    }

    public function daftarTilikVerifikasiPraOperasiPatient()
    {
        return $this->hasMany(DaftarTilikVerifikasiPraOperasiPatient::class);
    }

    public function ringkasanMasukDanKeluarPatient()
    {
        return $this->hasMany(RingkasanMasukDanKeluarPatient::class);
    }

    public function laporanOperasiPatient()
    {
        return $this->hasMany(LaporanOperasiPatient::class);
    }
    public function cpptRanaps()
    {
        return $this->hasMany(CpptRanap::class);
    }
    public function ranapDischargeSummaries()
    {
        return $this->hasMany(RanapDischargeSummary::class);
    }
    public function ranapInitialAssesments()
    {
        return $this->hasMany(RanapInitialAssesment::class);
    }
    public function ranapMedicineReceipts()
    {
        return $this->hasMany(RanapMedicineReceipt::class);
    }
    public function ranapPermintaanKonsulPenyakitDalamPatients()
    {
        return $this->hasMany(RanapPermintaanKonsulPenyakitDalamPatient::class);
    }
    public function ranapPersetujuanTindakanAnestesiPatients()
    {
        return $this->hasMany(RanapPersetujuanTindakanAnestesiPatient::class);
    }
    public function ranapPersetujuanTindakanBedahPatients()
    {
        return $this->hasMany(RanapPersetujuanTindakanBedahPatient::class);
    }
    public function ranapDischargePlanningGiziPharmacies()
    {
        return $this->hasMany(RanapDischargePlanningGiziPharmacy::class);
    }
    public function ranapDischargePlanningPerawatPatients()
    {
        return $this->hasMany(RanapDischargePlanningPerawatPatient::class);
    }
    public function ranapMonitoringCairanInfusPatients()
    {
        return $this->hasMany(RanapMonitoringCairanInfusPatient::class);
    }
    public function generalConsentPatient()
    {
        return $this->hasMany(GeneralConsentPatient::class);
    }
    public function ranapMonitoringResikoJatuhPatients()
    {
        return $this->hasMany(RanapMonitoringResikoJatuhPatient::class);
    }
    public function ranapRekapTindakanPelayananPatients()
    {
        return $this->hasMany(RanapRekapTindakanPelayananPatient::class);
    }
    public function ranapAssesmenPraSedations()
    {
        return $this->hasMany(RanapAssesmenPraSedation::class);
    }
    public function ranapAssesmenPraAnesthesias()
    {
        return $this->hasMany(RanapAssesmenPraAnesthesia::class);
    }
    public function ranapEwsDewasaPatients()
    {
        return $this->hasMany(RanapEwsDewasaPatient::class);
    }
    public function ranapEwsAnakPatients()
    {
        return $this->hasMany(RanapEwsAnakPatient::class);
    }
    public function ranapAsesMoniStatusFungsionalPatients()
    {
        return $this->hasMany(RanapAsesMoniStatusFungsionalPatient::class);
    }
    public function suratPernyataanPersetujuanPatients()
    {
        return $this->hasMany(SuratPernyataanPersetujuanPatient::class);
    }
    public function ranapHaisPatients()
    {
        return $this->hasMany(RanapHaisPatient::class);
    }
    public function suratPengantarRawatJalanPatient()
    {
        return $this->belongsTo(SuratPengantarRawatJalanPatient::class);
    }
    public function ranapMppPatient()
    {
        return $this->hasOne(RanapMppPatient::class);
    }
}
