<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'no_faktur',
        'tanggal',
        'total_kotor',
        'total_pajak',
        'total_diskon',
        'total_bayar',
        'status',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function medicineTransactions(){
        return $this->hasMany(MedicineTransaction::class);
    }
}
