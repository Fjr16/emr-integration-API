<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    // public function consultingRates(){
    //     return $this->hasMany(ConsultingRates::class);
    // }
    public function actionRates(){
        return $this->hasMany(ActionRate::class);
    }
    public function queues(){
        return $this->hasMany(Queue::class);
    }
    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
}
