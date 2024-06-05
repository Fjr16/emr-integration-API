<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapFormRekonsiliasiDetailVisite extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_form_rekonsiliasi_medicine_id',
        'tanggal',
        'keterangan',
    ];

    public function ranapFormRekonsiliasiMedicine(){
        return $this->belongsTo(RanapFormRekonsiliasiMedicine::class);
    }
}
