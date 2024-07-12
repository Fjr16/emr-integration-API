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
        'nama_obat_custom',
        'satuan_obat_custom',
        'jumlah',
        'aturan_pakai',
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
    public function medicineReceipt(){
        return $this->belongsTo(MedicineReceipt::class);
    }
}
