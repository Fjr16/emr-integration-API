<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'no_rm',
        'noka',
        'name',
        'tempat_lhr',
        'tanggal_lhr',
        'jenis_kelamin',
        'telp',
        'agama',
        'alamat',
        'rw',
        'rt',
        'pendidikan',
        'status',
        'nm_ayah',
        'nm_ibu',
        'nm_wali',
        'nik',
        'alergi',
        'suku',
        'isKaryawan',
        'bangsa',
    ];

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }
    public function igdPatients()
    {
        return $this->hasMany(IgdPatient::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function SkriningCovid()
    {
        return $this->hasMany(SkriningCovidRanapPatient::class);
    }

    protected static function booted()
    {
        static::creating(function ($patient) {
            $patient->no_rm = static::max('no_rm') + 1;
        });
    }

    public function prmrjs()
    {
        return $this->hasMany(Prmrj::class);
    }
    public function initialAssesments()
    {
        return $this->hasMany(InitialAssesment::class);
    }

    public function rmeCppts()
    {
        return $this->hasMany(RmeCppt::class);
    }
    public function medicineReceipts()
    {
        return $this->hasMany(MedicineReceipt::class);
    }

    public function radiologiFormRequests()
    {
        return $this->hasMany(RadiologiFormRequest::class);
    }

    public function laboratoriumRequests()
    {
        return $this->hasMany(LaboratoriumRequest::class);
    }

    public function rajalFarmasiObatInvoices()
    {
        return $this->hasMany(RajalFarmasiObatInvoice::class);
    }

    public function igdInitialAssesments()
    {
        return $this->hasMany(IgdInitialAssesment::class);
    }

    public function igdRmeCppts()
    {
        return $this->hasMany(IgdRmeCppt::class);
    }
    public function igdTriages()
    {
        return $this->hasMany(IgdTriage::class);
    }
    public function igdGeneralConsents()
    {
        return $this->hasMany(IgdGeneralConsent::class);
    }
    public function igdAseKepPatients()
    {
        return $this->hasMany(IgdAseKepPatient::class);
    }


    public function catatan()
    {
        return $this->hasMany(CatatanPerjalanRanapPatient::class, 'patient_id');
    }

    public function tilik()
    {
        return $this->hasMany(DaftarTilikVerifikasiPraOperasiPatient::class);
    }

    public function cpptRanaps()
    {
        return $this->hasMany(CpptRanap::class);
    }
    public function cpptKemoterapi()
    {
        return $this->hasMany(CpptKemoterapi::class);
    }
    public function ranapDischargeSummaries()
    {
        return $this->hasMany(RanapDischargeSummary::class);
    }

    public function permintaanLaboratoriumPatologiAnatomikPatient()
    {
        return $this->hasMany(PermintaanLaboratoriumPatologiAnatomikPatient::class);
    }
    public function radiologiPatient()
    {
        return $this->hasMany(RadiologiPatient::class);
    }
    public function laboratoriumPatientResult()
    {
        return $this->hasMany(LaboratoriumPatientResult::class);
    }
    public function suratBuktiPelayananPatients()
    {
        return $this->hasMany(SuratBuktiPelayananPatient::class);
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
    public function ranapMonitoringCairanInfusPatients()
    {
        return $this->hasMany(RanapMonitoringCairanInfusPatient::class);
    }
    public function ranapMppPatient()
    {
        return $this->hasMany(RanapMppPatient::class);
    }
    public function suratPengantarRawatJalanPatients()
    {
        return $this->hasMany(SuratPengantarRawatJalanPatient::class);
    }

    public function kemoterapiPatients()
    {
        return $this->hasMany(KemoterapiPatient::class);
    }
    public function kemoterapiGeneralConsents()
    {
        return $this->hasMany(KemoterapiGeneralConsent::class);
    }

    public function kemoterapiInitialAssesments()
    {
        return $this->hasMany(KemoterapiInitialAssesment::class);
    }

    public function kemoterapiRingkasanMasukdanKeluar()
    {
        return $this->hasMany(KemoterapiRingkasanMasukDanKeluarPatient::class);
    }

    public function kemoterapiMonitoringTindakanPatient()
    {
        return $this->hasMany(KemoterapiMonitoringTindakanPatient::class);
    }
}
