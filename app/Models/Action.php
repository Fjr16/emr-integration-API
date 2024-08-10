<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $with = ['actionRates'];
    protected $fillable = ['jenis_tindakan', 'action_code', 'name'];
    
    public function actionRates(){
        return $this->hasMany(ActionRate::class);
    }
}
