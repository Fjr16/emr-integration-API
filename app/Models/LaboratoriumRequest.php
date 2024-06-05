<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'queue_id',
        'laboratorium_request_type_master_id',
        'patient_category_id',
        'diagnosa',
        'ruang',
        'room_detail_id',
        'tanggal',
        'catatan'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function patientCategory(){
        return $this->belongsTo(PatientCategory::class);
    }
    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function laboratoriumRequestDetails(){
        return $this->hasMany(LaboratoriumRequestDetail::class);
    }
    public function laboratoriumPatientResult(){
        return $this->hasOne(laboratoriumPatientResult::class);
    }
    public function laboratoriumRequestTypeMaster(){
        return $this->belongsTo(LaboratoriumRequestTypeMaster::class);
    }
    public function roomDetail(){
        return $this->belongsTo(RoomDetail::class);
    }
}
