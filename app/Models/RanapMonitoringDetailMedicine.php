<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapMonitoringDetailMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_monitoring_medicine_id',
        'user_id',
        'tanggal',
        'jam',
        'jumlah',
    ];

    public function ranapMonitoringMedicine(){
        return $this->belongsTo(RanapMonitoringMedicine::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
