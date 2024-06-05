<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraAnestesiTechnique extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_assesmen_pra_anesthesia_id',
        'name',
        'value',
    ];

    public function ranapAssesmenPraAnesthesia(){
        return $this->belongsTo(RanapAssesmenPraAnesthesia::class);
    }
}
