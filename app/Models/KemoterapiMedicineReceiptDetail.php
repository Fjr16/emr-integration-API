<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiMedicineReceiptDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'kemoterapi_medicine_receipt_id',
        'medicine_id',
        'jumlah',
        'aturan_pakai',
        'keterangan',
        'other',
    ];

    public function kemoterapiMedicineReceipt(){
        return $this->belongsTo(KemoterapiMedicineReceipt::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
