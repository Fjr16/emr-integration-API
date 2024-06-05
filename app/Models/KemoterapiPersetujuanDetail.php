<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemoterapiPersetujuanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kemoterapi_persetujuan_id',
        'jenis',
        'isi',
        'ttd',
    ];

    public function kemoterapiPersetujuan(){
        return $this->belongsTo(kemoterapiPersetujuan::class);
    }
}
