<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['name' , "patient_id" , "added_by" , "healthcare_entity_id" , 'service_id' , "phone" , "current" , "type" , "status" , "started_at" , 'time_passed'];
    const types = ["registration" , "appointment"];

    const status = [
        'pending',
        'canceled',
        'done',
        'waiting'
    ];

    public function service():BelongsTo
    {
        return $this->belongsTo(Service::class , "service_id");
    }

    public function patient():BelongsTo
    {
        return $this->belongsTo(Patient::class , "patient_id");
    }

    public function healthcareEntity()
    {
        return $this->belongsTo(HealthcareEntity::class , 'healthcare_entity_id');
    }
}
