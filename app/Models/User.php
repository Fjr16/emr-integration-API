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
        'unit_id',
        'room_detail_id',
        'password',
        'status',
        'isDokter',
        'paraf',
        'sip',
        'kode_dokter_bpjs',
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
    public function unit()
    {
        return $this->belongsTo(Unit::class);
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

    public function rajalFarmasiPatient()
    {
        return $this->hasMany(RajalFarmasiPatient::class);
    }
    public function kasirPatients()
    {
        return $this->hasMany(KasirPatient::class);
    }

    public function consultingRates()
    {
        return $this->hasMany(ConsultingRates::class);
    }
}
