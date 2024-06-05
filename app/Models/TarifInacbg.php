<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifInacbg extends Model
{
    use HasFactory;
    protected $fillable = [
        'kasir_patient_id',
        'queue_id',
        'sep_id',
        'status_claim'
    ];

    public function kasirPatientId()
    {
        return $this->belongsTo(KasirPatient::class);
    } 

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    } 

    public function sep()
    {
        return $this->belongsTo(Sep::class);
    } 

    public function tindakanIcd(){
        return $this->hasMany(TindakanIcd::class);
    }
}
