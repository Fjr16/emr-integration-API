<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalGeneralConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rawat_jalan_patient_id',
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

    public function rajalGeneralConsentDetails(){
        return $this->hasMany(RajalGeneralConsentDetail::class);
    }
    public function rawatJalanPatient(){
        return $this->belongsTo(RawatJalanPatient::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
