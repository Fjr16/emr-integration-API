<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanapAssesmenPraSedationPersiapanBlood extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranap_assesmen_pra_sedation_anestesi_instruction_id',
        'name',
        'value',
    ];

    public function ranapAssesmenPraSedationAnestesiInstruction(){
        return $this->belongsTo(RanapAssesmenPraSedationAnestesiInstruction::class);
    }
}
