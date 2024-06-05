<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapPersetujuanTindakanBedahPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'petugas',
        'name',
        'umur',
        'jenis_kelamin',
        'alamat',
        'hubungan',
        'tanggal',
        'ttdKet1',
        'ttdKet2',
        'ttdPenerimaInformasi',
        'hub1',
        'ttdHub1',
        'namaHub1',
        'hub2',
        'ttdHub2',
        'namaHub2',
    ];

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ranapDetailPersetujuanTindakanBedahPatients()
    {
        return $this->hasMany(RanapDetailPersetujuanTindakanBedahPatient::class);
    }
}
