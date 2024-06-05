<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanOperasiPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'rawat_inap_patient_id',
        'nama_ahli_bedah',
        'asisten_bedah',
        'nama_ahli_anestesi',
        'jenis_anestesi',
        'tingkatan_operasi',
        'diagnosis_pra_operasi',
        'diagnosis_pasca_operasi',
        'nama_operasi',
        'komplikasi',
        'spesimen_operasi_pemeriksaan_pa',
        'jumlah_pendarahan',
        'jumlah_darah_ditransfusi',
        'tanggal',
        'jam_dimulai',
        'jam_selesai',
        'lama_operasi',
        'prosedur_operasi',
        'nomor_implan',
        'instruksi_ruangan',
        'ttd_pasien',
        'diJelaskan',
    ];

    public function detailLaporanOperasiPatient()
    {
        return $this->hasMany(DetailLaporanOperasiPatient::class);
    }

    public function rawatInapPatient()
    {
        return $this->belongsTo(RawatInapPatient::class,);
    }
}
