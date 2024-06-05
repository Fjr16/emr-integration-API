<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratBuktiPelayananSekunderAction extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_bukti_pelayanan_patient_id',
        'action_name',
        'action_icdg',
    ];

    public function suratBuktiPelayananPatient(){
        return $this->belongsTo(SuratBuktiPelayananPatient::class);
    }
}
