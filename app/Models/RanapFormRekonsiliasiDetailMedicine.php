<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapFormRekonsiliasiDetailMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_form_rekonsiliasi_medicine_id',
        'medicine_id',
        'frekuensi',
        'rute',
        'isAdmisi',
        'ruangTf1',
        'isTransfer1',
        'ruangTf2',
        'isTransfer2',
        'ruangTf3',
        'isTransfer3',
        'isPulang',
        'tanggal',
    ];

    public function ranapFormRekonsiliasiMedicine(){
        return $this->belongsTo(RanapFormRekonsiliasiMedicine::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
