<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralConsentPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rawat_inap_patient_id',
        'name',
        'tgl_lhr',
        'kelamin',
        'alamat',
        'phone',
        'hubungan',
        'dpjp',
        'kebutuhan_privasi1',
        'kebutuhan_privasi2',
        'kebutuhan_privasi3',
        'kebutuhan_privasi_khusus',
        'harta_benda',
        'persetujuan_pelepasan_informasi',
        'ttd',
        'ttd_admisi',
    ];

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class,);
    }
}
