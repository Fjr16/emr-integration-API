<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewRadiologiRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'queue_id',
        'patient_id',
        'room_detail_id',
        'diagnosa_klinis',
        'catatan',
        'ttd_dokter'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function roomDetail()
    {
        return $this->belongsTo(RoomDetail::class);
    }

    //relasi ke daftar pasien radiologi
    public function radiologiPatient()
    {
        return $this->hasOne(RadiologiPatient::class);
    }

    public function newEkstremitasAtas()
    {
        return $this->hasMany(NewEkstremitasAtas::class);
    }

    public function newEkstremitasBawah()
    {
        return $this->hasMany(NewEkstremitasBawah::class);
    }

    public function newLainLain()
    {
        return $this->hasMany(NewLainLain::class);
    }

    public function newUsg()
    {
        return $this->hasMany(NewUSG::class);
    }

    public function newKontras()
    {
        return $this->hasMany(NewKontras::class);
    }

    public function newPemeriksaanLainnya()
    {
        return $this->hasMany(NewPemeriksaanLainnya::class);
    }
}
