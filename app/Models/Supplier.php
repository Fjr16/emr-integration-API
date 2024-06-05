<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alamat',
        'telp',
        'npwp',
        'no_izin',
        'contact_person_name',
        'contact_person_phone',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
