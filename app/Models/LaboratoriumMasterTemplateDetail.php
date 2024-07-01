<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumMasterTemplateDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_master_template_id',
        'action_id',
        'keterangan',
    ];

    public function laboratoriumMasterTemplate() {
        return $this->belongsTo(LaboratoriumMasterTemplate::class);
    }
    public function action() {
        return $this->belongsTo(Action::class);
    }
}
