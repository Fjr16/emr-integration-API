<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestDetail extends Model
{
    use HasFactory;

    protected $with = ['action'];

    protected $fillable = [
        'laboratorium_request_id',
        'action_id',
        'keterangan',  
        'hasil',    //tipe float
        'satuan',
        'kritis',   //boolean
    ];


    public function laboratoriumRequest(){
        return $this->belongsTo(LaboratoriumRequest::class);
    }
    public function action(){
        return $this->belongsTo(Action::class);
    }
}
