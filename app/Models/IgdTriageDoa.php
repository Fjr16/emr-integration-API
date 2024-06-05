<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdTriageDoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'igd_triage_id',
        'kehidupan',
        'nadi',
        'reflek',
        'ekg',
        'jam_doa',
    ];

    public function IgdTriage(){
        return $this->belongsTo(IgdTriage::class);
    }
}
