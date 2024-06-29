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
        'keterangan',   //terletak pada add_to_radiologi_form_request_details
        'user_id',  //petugas radiologi
        'tanggal_periksa',
        'hasil',
        'image',
        'status',
    ];

    public function radiologiFormRequest() {
        return $this->belongsTo(RadiologiFormRequest::class);
    }
    public function action() {
        return $this->belongsTo(Action::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
