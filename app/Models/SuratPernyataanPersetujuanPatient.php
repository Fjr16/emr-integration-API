<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPernyataanPersetujuanPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'user_id',
        'name',
        'umur',
        'alamat',
        'hubungan',
        'ctt_khusus',
        'paraf',
        'header',
        'jaminan',
        'dariKelas',
        'keKelas',
        'statusAdm',
        'ttd',
    ];


    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detailAdmPernyataanPersetujuanPatients()
    {
        return $this->hasMany(DetailAdmPernyataanPersetujuanPatient::class);
    }
}
