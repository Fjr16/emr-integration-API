<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiPersetujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_patient_id',
        'patient_id',
        'user_id',
        'petugas',
        'name',
        'umur',
        'jenis_kelamin',
        'alamat',
        'hubungan',
        'tanggal',
        'ttdKet1',
        'ttdKet2',
        'ttdPenerimaInformasi',
        'hub1',
        'ttdHub1',
        'namaHub1',
        'hub2',
        'ttdHub2',
        'namaHub2',
        'tindakan'
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function kemoterapiPatient(){
        return $this->belongsTo(kemoterapiPatient::class);
    }
    public function kemoterapiPersetujuanDetail(){
        return $this->hasMany(kemoterapiPersetujuanDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
