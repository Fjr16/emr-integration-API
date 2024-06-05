<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiDetailPsikoSosioSpritualDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $table = 'kemoterapi_detail_psiko_sosio_spritual_diagnosa_keperawatan';
    protected $fillable = [
        'kemoterapi_psiko_sosio_spritual_diagnosa_keperawatan_patient_id',
        'category',
        'value',
        'name',
    ];

    public function kemoterapipsikoSosioSpritualDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(KemoterapiPsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }
}
