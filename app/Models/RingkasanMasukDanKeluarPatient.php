<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RingkasanMasukDanKeluarPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'rawat_inap_patient_id',
        'patient_id',
        'tanggal_masuk',
        'jam_masuk',
        'tanggal_keluar',
        'jam_keluar',
        'lama_dirawat',
        'pendidikan_terakhir',
        'tahun_kunjungan',
        'dirawat_ke',
        'ruang_rawat',
        'alamat_sesuai_ktp',
        'alamat_sesuai_domisili',
        'no_telphone',
        'email',
        'suku_bangsa',
        'agama',
        'pekerjaan',
        'keyakinan',
        'nilai_nilai_pribadi',
        'bahasa',
        'kedatangan_pasien',
        'hambatan_bahasa',
        'kebutuhan_penerjemah',
        'kebutuhan_disabilitas',
        'jalur_masuk_rumahsakit',
        'mutasi_bangsal_1',
        'mutasi_pindah_bangsal_1',
        'tanggal_bangsal_1',
        'mutasi_bangsal_2',
        'mutasi_pindah_bangsal_2',
        'tanggal_bangsal_2',
        'keadaan_keluar',
        'cara_keluar',
        'meninggal',
        'diagnosa_utama',
        'diagnosa_sekunder',
        'komplikasi_dan_resiko',
        'tindakan_operasi',
        'riwayat_alergi',
        'riwayat_transfusi',
        'tanggal_aps',
        'jam_aps',
        'tanggal_kontrol',
        'jam_kontrol',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class,);
    }
    
    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class,);
    }
}
