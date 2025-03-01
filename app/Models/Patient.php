<?php

namespace App\Models;

use Carbon\Carbon;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [
        'no_rm',
    ];

    protected $fillable = [
        'job_id',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
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
        'alergi_makanan',
        'alergi_obat',
        'suku',
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
            $sequenceNumber = SequenceNumber::getNextNumber();
            $today = Carbon::now();
            $year = $today->format('y');
            $month = $today->format('m');
            $day = $today->format('d');
            $medicalRecordNumber = "$year-$month-$day-$sequenceNumber";

            $patient->no_rm = $medicalRecordNumber;
        });
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
    public function perawatInitialAsesments() {
        return $this->hasMany(PerawatInitialAsesment::class);
    }
    public function rajalFarmasiPatients() {
        return $this->hasMany(RajalFarmasiPatient::class);
    }
}
