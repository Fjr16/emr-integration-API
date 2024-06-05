<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RajalGeneralConsentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rajal_general_consent_id',
        'name',
        'hub',
    ];

    public function rajalGeneralConsent() {
        return $this->belongsTo(RajalGeneralConsent::class);
    }
}
