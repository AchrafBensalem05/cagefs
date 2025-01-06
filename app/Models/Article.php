<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['title' , 'collecting_time' , 'section' , 'area' , 'medication_type' , 'payments' , 'medication' , 'healthcare_id' ,
        'author_id' , 'pin'  , 'pinner_id' ,  'blood' , 'location' ,'content' , 'wilaya' , 'daira' , 'language' , 'emergency' ,
      'status' , 'started_at'];

    const Section = ["blood" , "medication" , "medication_demand"];

    public function user()
    {
        return $this->belongsTo(Patient::class , 'author_id');
    }

    public function wilaya_rel()
    {
        return $this->belongsTo(Wilaya::class , 'wilaya');
    }

    public function daira_rel()
    {
        return $this->belongsTo(Daira::class , 'daira');
    }


    public function likes()
    {
        return $this->hasMany(Favoritearticle::class)->where('type' , 'like');
    }


    public function favorites()
    {
        return $this->hasMany(Favoritearticle::class)->where('type' , 'favorite');
    }


    public function reports()
    {
        return $this->hasMany(Favoritearticle::class)->where('type' , 'report');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('gallery')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('square')
                    ->fit(Manipulations::FIT_CROP, 200, 200);
                $this
                    ->addMediaConversion('main')
                    ->fit(Manipulations::FIT_CROP, 372, 410);

            });
    }


}
