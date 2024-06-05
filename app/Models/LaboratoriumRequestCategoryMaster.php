<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestCategoryMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function laboratoriumRequestMasterVariables(){
        return $this->hasMany(LaboratoriumRequestMasterVariable::class);
    }
}
