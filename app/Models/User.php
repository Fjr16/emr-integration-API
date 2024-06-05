<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nik',
        'email',
        'ayah',
        'ibu',
        'gender',
        'status_kawin',
        'jumlah_anak',
        'tgl_lahir',
        'tgl_masuk',
        'telp',
        'nama_kontak_darurat',
        'no_kontak_darurat',
        'alamat_ktp',
        'alamat_domisili',
        'alamat_kontak_darurat',
        'pendidikan',
        'pengalaman',
        'nama_rekening',
        'no_rekening',
        'catatan',
        'staff_id',
        'unit_category_id',
        'room_detail_id',
        'password',
        'status',
        'isDokter',
        'paraf',
    ];

    protected $with = [
        'roomDetail',
        'doctorSchedules',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }
    public function igdPatients()
    {
        return $this->hasMany(IgdPatient::class);
    }
    public function unitCategory()
    {
        return $this->belongsTo(UnitCategory::class);
    }

    public function roomDetail()
    {
        return $this->belongsTo(RoomDetail::class);
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'user_specialists');
    }

    public function doctorSchedules()
    {
        return $this->hasMany(DoctorsSchedule::class);
    }

    public function doctorPatients()
    {
        return $this->hasMany(DoctorPatient::class);
    }
    public function laboratoriumUserValidator()
    {
        return $this->hasMany(LaboratoriumUserValidator::class);
    }

    public function initialAssesments()
    {
        return $this->hasMany(InitialAssesment::class);
    }

    public function rmeCppts()
    {
        return $this->hasMany(RmeCppt::class);
    }
    public function prmrjs()
    {
        return $this->hasOne(Prmrj::class);
    }
    public function medicineReceipts()
    {
        return $this->hasMany(MedicineReceipt::class);
    }

    public function changeLogs()
    {
        return $this->hasMany(ChangeLog::class);
    }
    public function radiologiFormRequests()
    {
        return $this->hasMany(RadiologiFormRequest::class);
    }
    public function radiologiPatients()
    {
        return $this->hasMany(RadiologiPatient::class);
    }
    public function radiologiPatientRequestDetails()
    {
        return $this->hasMany(RadiologiPatientRequestDetail::class);
    }
    public function laboratoriumRequests()
    {
        return $this->hasMany(LaboratoriumRequest::class);
    }

    public function rajalFarmasiObatInvoices()
    {
        return $this->hasMany(RajalFarmasiObatInvoice::class);
    }

    public function igdRmeCppts()
    {
        return $this->hasMany(IgdRmeCppt::class);
    }
    public function igdTriages()
    {
        return $this->hasMany(IgdTriage::class);
    }
    public function cpptRanaps()
    {
        return $this->hasMany(CpptRanap::class);
    }
    public function kasirPatients()
    {
        return $this->hasMany(KasirPatient::class);
    }

    public function consultingRates()
    {
        return $this->hasMany(ConsultingRates::class);
    }
    public function ranapDpjpPatientDetails()
    {
        return $this->hasMany(ranapDpjpPatientDetails::class);
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
    public function ranapHaisPatients()
    {
        return $this->hasMany(KasirPatient::class);
    }
    public function ranapMppPatient()
    {
        return $this->hasMany(RanapMppPatient::class);
    }

    // kemoterapi
    public function kemoterapiPatient()
    {
        return $this->hasOne(KemoterapiPatient::class);
    }
}
