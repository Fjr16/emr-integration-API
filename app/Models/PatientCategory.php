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

    public function bedroomRate(){
        return $this->hasMany(BedroomRate::class);
    }

    public function actionMemberRates(){
        return $this->hasMany(ActionMemberRates::class);
    }

    public function radiologiFormRequestMasterRates(){
        return $this->hasMany(RadiologiFormRequestMasterRate::class);
    }
    public function laboratoriumRequestMasterRates(){
        return $this->hasMany(LaboratoriumRequestMasterRate::class);
    }

    public function queues(){
        return $this->hasMany(Queue::class);
    }

    public function igdPatients(){
        return $this->hasMany(IgdPatient::class);
    }
    public function rajalFarmasiObatDetails(){
        return $this->hasMany(RajalFarmasiObatDetail::class);
    }
}
