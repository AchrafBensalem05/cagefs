<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model  implements HasMedia
{
    use HasFactory ,  InteractsWithMedia , HasSlug;

    protected $fillable = ['title' , 'description' , 'slug' , "icon" , 'type'];

    public function healthcareEntities()
    {
        return $this->belongsToMany(HealthcareEntity::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('icon')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 50, 50)
                    ->keepOriginalImageFormat();
            });
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
