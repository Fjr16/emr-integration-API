<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAnotherMonitoringMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_monitoring_medicine_id',
        'medicine_id',
        'user_id',
        'skin_test',
        'alergi',
    ];

    public function ranapMonitoringMedicine(){
        return $this->belongsTo(RanapMonitoringMedicine::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
