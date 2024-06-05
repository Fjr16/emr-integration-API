<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMedicineReceiptDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_medicine_receipt_id',
        'medicine_id',
        'jumlah',
        'aturan_pakai',
        'keterangan',
        'other',
        'category',
    ];

    public function ranapMedicineReceipt(){
        return $this->belongsTo(RanapMedicineReceipt::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
