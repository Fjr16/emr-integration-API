<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumMasterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function laboratoriumMasterTemplateDetails() {
        return $this->hasMany(LaboratoriumMasterTemplateDetail::class);
    }
}
