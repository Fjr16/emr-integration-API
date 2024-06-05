<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestesiReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'queue_id',
        'patient_id',
        'nama_penata_anestesi',
        'ttd_penata_anestesi',
        'nama_dokter_anestesi',
        'ttd_dokter_anestesi',
        'perifer_first',
        'perifer_second',
        'perifer_cvc',
        'posisi',
        'perlindungan_mata',
        'pre_oral',
        'pre_im',
        'pre_iv',
        'induksi_intravena',
        'induksi_inhalasi',
        'lama_pembiusan_jam',
        'lama_pembiusan_menit',
        'lama_pembedahan_jam',
        'lama_pembedahan_menit',
        'keterangan',
    ];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function anestesiReportAirway(){
        return $this->hasOne(AnestesiReportAirway::class);
    }
    public function anestesiReportIntubasis(){
        return $this->hasMany(AnestesiReportIntubasi::class);
    }
    public function anestesiReportPerifer(){
        return $this->hasOne(AnestesiReportPerifer::class);
    }
    public function anestesiReportVentilations(){
        return $this->hasMany(AnestesiReportVentilation::class);
    }
    public function anestesiReportAnasthesias(){
        return $this->hasMany(AnestesiReportAnasthesia::class);
    }
    public function anestesiReportMonitorings(){
        return $this->hasMany(AnestesiReportMonitoring::class);
    }
    public function anestesiReportMedicine(){
        return $this->hasOne(AnestesiReportMedicine::class);
    }
}
