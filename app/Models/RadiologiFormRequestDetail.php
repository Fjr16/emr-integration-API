<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologiFormRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiologi_form_request_id',
        'action_id',
        'value',
    ];

    public function radiologiFormRequest() {
        return $this->belongsTo(RadiologiFormRequest::class);
    }
    public function action() {
        return $this->belongsTo(Action::class);
    }
}
