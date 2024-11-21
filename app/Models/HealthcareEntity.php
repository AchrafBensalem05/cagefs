<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\OpeningHours\OpeningHours;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use DateTimeZone;

class HealthcareEntity extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable , InteractsWithMedia , HasSlug;


    const Types = [
      '0'   =>  'Doctor',
      '1'   =>  'Clinic',
      '2'   =>  'Hospital',
      '3'   =>  'Laboratory',
      '4'   =>  'Pharmacist'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'address',
        'description',
        'name',
        'email',
        'password',
        'auth0_google',
        'titulation',
        'fname',
        'lname',
        'daira_id',
        'slug',
        'blocked',
        'maps',
        'opening_hours',
        'healthcares',
        'opening_hours_display',
        'phones',
        'average_patient_time',
        'open_registration_for_day',
        'time_before_open_registration_for_day',
        'closure_reason',
        'closed_in_date',
        'limit_patient',
        'tags',
        'experience',
        'languages',
        'diplomas',
        'equipment',
        'payments',
        'customers_result',
        'expired_at'
    ];










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
        'expired_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function services()
    {
        return $this->belongsToMany(Service::class , 'healthcare_entity_service'  ,'healthcare_entity_id' , 'service_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class , 'healthcare_entity_id')->where('type' , 'appointment');
    }
    public function registrations()
    {
        return $this->hasMany(Appointment::class , 'healthcare_entity_id')->where('type' , 'registration');
    }

    public function all_appoints()
    {
        return $this->hasMany(Appointment::class , 'healthcare_entity_id');
    }

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

            });
        $this
            ->addMediaCollection('thumbnail')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('sized')
                    ->fit(Manipulations::FIT_CROP, 161, 296);

            });
        $this
            ->addMediaCollection('background')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('sized')
                    ->fit(Manipulations::FIT_CROP, 1554, 350);

            });

        $this->addMediaCollection('qrcode')
            ->useDisk('public');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function OpeningHoursObj():Attribute
    {
      return  Attribute::make(function ()
      {
          if (is_array(json_decode($this->opening_hours , true)) )
                return OpeningHours::create(json_decode($this->opening_hours , true)  , (new DateTimeZone('Africa/Algiers')));
          else
              return null;
      });
    }

    public function isOpenNow():Attribute
    {
        return Attribute::make(function ()
        {
            if($this->closed_in_date != null and $this->closed_in_date == \Carbon\Carbon::now()->toDateString())
                return "closed";
            if($this->opening_hours_obj instanceof OpeningHours)
               return ($this->opening_hours_obj->isOpen()) ? 'open'   : 'closed' ;
            else
                return 'unknown';
        });
    }

    public function nextOpen():Attribute
    {
        return Attribute::make(function ()
        {
            try {
                return ($this->opening_hours_obj->nextOpen(now())->format('Y-m-d H:i') . "\n");
            }
            catch (\Exception)
            {
                return 'unknown';
            }
        });
    }


    public function registrationsForTheOpenedDay():Attribute
    {
        return Attribute::make(function ()
        {
            try{
                if ($this->open_registration_for_day)
                   return $this->all_appoints->ToQuery()->where("started_at"  , ">" ,$this->open_registration_for_day)->where('status' , '<>' , 'waiting')

                       ->orderBy('started_at')->get();
                else
                    return null;
            }
            catch (\Exception $exception)
            {
                return null;
            }
        });
    }

    public function nextOpeningRegistrationsTime():Attribute
    {
        return Attribute::make(function ()
        {
            if ($this->open_registration_for_day and $this->time_before_open_registration_for_day)
                return Carbon::parse($this->open_registration_for_day . ' ' . $this->time_before_open_registration_for_day)->subDay()->toDateTime();
            else
                return null;
        }
        );
    }

    public function getCurrentRegistrationForDay():Attribute
    {
        return Attribute::make(function ()
        {
          return  $this->registrations_for_the_opened_day->where('status', 'pending')->where('current' , 'yes')->count() ?
                $this->registrations_for_the_opened_day->where('status', 'pending')->where('current' , 'yes')->first() :
                $this->registrations_for_the_opened_day->where('status', 'pending')->first();
        });
    }


    /*Chat needs*/

    public function sent_messages()
    {
        return $this->hasMany(Message::class , 'sender_id')->where('sender_type' , 'healthcare');
    }


    public function received_messages()
    {
        return $this->hasMany(Message::class , 'receiver_id')->where('receiver_type' , 'healthcare');
    }


    public function chat_patients()
    {
        $healthcareId = $this->id;
       $array =  \DB::table('patients')
            ->join('messages', function ($join) use ($healthcareId) {
                $join->on('patients.id', '=', 'messages.sender_id')
                    ->where('messages.sender_type', '=', 'patient')
                    ->where('messages.receiver_type', '=', 'healthcare')
                    ->where('messages.receiver_id', '=', $healthcareId)
                    ->orWhere(function ($query) use ($healthcareId) {
                        $query->on('patients.id', '=', 'messages.receiver_id')
                            ->where('messages.sender_type', '=', 'healthcare')
                            ->where('messages.sender_id', '=', $healthcareId)
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
}
