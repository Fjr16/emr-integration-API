<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestTypeMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isPrioritas',
    ];

    public function laboratoriumRequests(){
        return $this->hasMany(LaboratoriumRequest::class);
    }
}
