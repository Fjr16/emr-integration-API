<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineReceiptDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_receipt_id',
        'medicine_id',
        'jumlah',
        'aturan_pakai',
        'keterangan',
        'other',
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
    public function medicineReceipt(){
        return $this->belongsTo(MedicineReceipt::class);
    }
}
