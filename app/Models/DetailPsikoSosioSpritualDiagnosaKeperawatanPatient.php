<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPsikoSosioSpritualDiagnosaKeperawatanPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'psiko_sosio_spritual_diagnosa_keperawatan_patient_id',
        'category',
        'value',
        'name',
    ];

    public function psikoSosioSpritualDiagnosaKeperawatanPatient()
    {
        return $this->belongsTo(PsikoSosioSpritualDiagnosaKeperawatanPatient::class);
    }
}
