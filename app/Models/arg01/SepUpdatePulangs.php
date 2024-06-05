<?php

namespace App\Models\arg01;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepUpdatePulangs extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_seps',
        'no_sep',
        'kd_status_pulang',
        'status_pulang',
        'no_surat_meninggal',
        'tgl_meninggal',
        'tgl_pulang',
        'no_lp_manual',
        'user',
    ];
}