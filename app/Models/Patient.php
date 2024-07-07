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
    public function permintaanLaboratoriumPatologiAnatomikPatient()
    {
        return $this->hasMany(PermintaanLaboratoriumPatologiAnatomikPatient::class);
    }
    public function suratBuktiPelayananPatients()
    {
        return $this->hasMany(SuratBuktiPelayananPatient::class);
    }

    public function perawatInitialAsesments() {
        return $this->hasMany(PerawatInitialAsesment::class);
    }
}
