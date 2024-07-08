<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatInitialAsesment extends Model
{
    use HasFactory;
    protected $fillable = [
        'queue_id',
        'patient_id',
        'user_id',
        'keluhan_utama',
        'riw_penyakit_pasien',
        'riw_penyakit_keluarga',
        'skor_ass_gizi_1',
        'skor_ass_gizi_2',
        'kondisi_gizi',
        'nadi',
        'td_sistolik',
        'td_diastolik',
        'suhu',
        'nafas',
        'keadaan_umum',
        'kesadaran',
        'tb',
        'bb',
        'lk',
        'skor_nyeri',
        'stts_ekonomi',
        // resiko jatuh
        'resiko_jatuh_a',
        'resiko_jatuh_b',
        'resiko_jatuh_result',
        // soap
        'subjective',
        'objective',
        'asesmen',
        'planning',
        'ttd',
    ];

    public function detailPsikologis(){
        return $this->hasMany(PerawatInitialAsesmentPsychology::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
