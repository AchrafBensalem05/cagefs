<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Voucher extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia ;

    protected $fillable = ['title' , 'healthcare_id' , 'status' , 'pricing_id'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('file')
            ->registerMediaConversions(function (Media $media)
            {

            });
    }

    public function healthcare()
    {
        return $this->belongsTo(HealthcareEntity::class , 'healthcare_id');
    }


    public function pricing()
    {
        return $this->belongsTo(Pricing::class , 'pricing_id');
    }


}
