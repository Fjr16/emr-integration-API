<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiGeneralConsent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kemoterapi_patient_id',
        'patient_id',
        'name',
        'tgl_lhr',
        'kelamin',
        'alamat',
        'phone',
        'hubungan',
        'kebutuhan_privasi1',
        'kebutuhan_privasi2',
        // 'kebutuhan_privasi3',
        'kebutuhan_privasi_khusus',
        'harta_benda',
        'persetujuan_pelepasan_informasi',
        'ttd',
        'ttd_admisi',
    ];

    public function kemoterapiPatient()
    {
        return $this->belongsTo(KemoterapiPatient::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
