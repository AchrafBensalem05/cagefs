<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable implements HasMedia
{
    use HasFactory , HasApiTokens , Notifiable , InteractsWithMedia ;
    protected $fillable = ['name' , 'blood'  , 'donor','lname' , 'auth0_google' , 'fname' , 'email' , 'password' , 'phone' , 'sex' , 'birth_date' , 'address' , "blocked" , 'daira_id' , 'chronic_diseases'];

    const bloud_group = ["O+","O-","B+","B-","A+","A-","AB-","AB+"];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function daira()
    {
        return $this->belongsTo(Daira::class , 'daira_id');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 96, 96);
                $this
                    ->addMediaConversion('sized')
                    ->fit(Manipulations::FIT_CROP, 161, 296);

            });
    }


    public function chat_with_healthcare($healthcareId)
    {
        $array =  \DB::table('messages')
                    ->where(function ($query) use ($healthcareId){
                        $query->where('messages.sender_type', '=', 'patient')
                            ->where('messages.sender_id', '=', $this->id)
                            ->where('messages.receiver_type', '=', 'healthcare')
                            ->where('messages.receiver_id', '=', $healthcareId);
                    })
                    ->orWhere(function ($query) use ($healthcareId) {
                        $query->where('messages.sender_type', '=', 'healthcare')
                            ->where('messages.sender_id', '=', $healthcareId)
                            ->where('messages.receiver_type', '=', 'patient')
                            ->where('messages.receiver_id', '=', $this->id);
                    })->select('messages.*')->get();

        return $array->map(function ($message) {
            return Message::find($message->id);
        });
    }

    public function chat_with_patient($patientId)
    {
        $array =  \DB::table('messages')
            ->where(function ($query) use ($patientId){
                $query->where('messages.sender_type', '=', 'patient')
                    ->where('messages.receiver_type', '=', 'patient')
                    ->where('messages.receiver_id', '=', $patientId);
            })
            ->orWhere(function ($query) use ($patientId) {
                $query->where('messages.sender_type', '=', 'patient')
                    ->where('messages.sender_id', '=', $patientId)
                    ->where('messages.receiver_type', '=', 'patient');
            })->select('messages.*')->get();

        return $array->map(function ($message) {
            return Message::find($message->id);
        });
    }

    public function chat_healthcares()
    {
        $patientId = $this->id;
        $array =  \DB::table('healthcare_entities')
            ->join('messages', function ($join) use ($patientId) {
                $join->on('healthcare_entities.id', '=', 'messages.sender_id')
                    ->where('messages.sender_type', '=', 'healthcare')
                    ->where('messages.receiver_type', '=', 'patient')
                    ->where('messages.receiver_id', '=', $patientId)
                    ->orWhere(function ($query) use ($patientId) {
                        $query->on('healthcare_entities.id', '=', 'messages.receiver_id')
                            ->where('messages.sender_type', '=', 'patient')
                            ->where('messages.sender_id', '=', $patientId)
                            ->where('messages.receiver_type', '=', 'healthcare');
                    });
            })
            ->select('healthcare_entities.*')
            ->distinct()
            ->get();

        return $array->map(function ($healthData) {
            return HealthcareEntity::find($healthData->id);
        });
    }


    public function chat_patients()
    {
        $patientId = $this->id;
        $array =  \DB::table('patients')
            ->join('messages', function ($join) use ($patientId) {
                $join->on('patients.id', '=', 'messages.sender_id')
                    ->where('messages.sender_type', '=', 'patient')
                    ->where('messages.receiver_type', '=', 'patient')
                    ->where('messages.receiver_id', '=', $patientId)
                    ->orWhere(function ($query) use ($patientId) {
                        $query->on('patients.id', '=', 'messages.receiver_id')
                            ->where('messages.sender_type', '=', 'patient')
                            ->where('messages.sender_id', '=', $patientId)
                            ->where('messages.receiver_type', '=', 'patient');
                    });
            })
            ->select('patients.*')
            ->distinct()
            ->get();

        return $array->map(function ($patientData) {
            return Patient::find($patientData->id);
        });
    }

    public function favorites()
    {
             return $this->hasMany(Favoritearticle::class,  'user_id')->where('type' , 'favorite');
    }

}
