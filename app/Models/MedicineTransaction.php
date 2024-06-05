<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'unit_id',
        'medicine_id',
        'jumlah',
        'satuan',
        'harga',
        'total_harga',
        'no_batch',
        'production_date',
        'exp_date',
        'pajak',
        'diskon',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
