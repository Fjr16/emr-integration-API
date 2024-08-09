<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SequenceNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_rm_number',
    ];

    public static function getNextNumber()
    {
        return DB::transaction(function () {
            $lastNumber = SequenceNumber::lockForUpdate()->first();

            if (!$lastNumber) {
                $lastNumber = new SequenceNumber(['last_rm_number' => 0]);
                $lastNumber->save();
            }
    
            $lastNumber->last_rm_number++;
            $rmNext = str_pad($lastNumber->last_rm_number, 3, '0', STR_PAD_LEFT);
            $lastNumber->save();

            return $rmNext;
        });
    }
}
