<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newusg extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'new_radiologi_request_id', 'value'];

    public function newReadiologiRequest()
    {
        return $this->belongsTo(NewRadiologiRequest::class);
    }
}
