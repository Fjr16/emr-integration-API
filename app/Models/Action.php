<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['action_category_id', 'icd_code', 'name'];
    
    public function category(){
        return $this->belongsTo(ActionCategory::class);
    }

    public function actionRates(){
        return $this->hasMany(ActionRate::class);
    }
}
