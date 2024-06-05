<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgdTriageCheckup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'igd_triage_scale_id',
        'igd_triage_category_checkup_id',
    ];

    public function IgdTriageScale(){
        return $this->belongsTo(IgdTriageScale::class);
    }
    public function IgdTriageCategoryCheckup(){
        return $this->belongsTo(IgdTriageCategoryCheckup::class);
    }

    public function igdTriages(){
        return $this->belongsToMany(IgdTriage::class, 'igd_triage_details');
    }
}
