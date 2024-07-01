<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratorium_request_id',
        'action_id',
        'keterangan',  
        'user_id',  //petugas lab pk
        'tanggal_periksa',
        'hasil',
        'status',
    ];


    public function laboratoriumRequest(){
        return $this->belongsTo(LaboratoriumRequest::class);
    }
    public function action(){
        return $this->belongsTo(Action::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
