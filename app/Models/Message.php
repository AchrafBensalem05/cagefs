<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Message extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = ['sender_id' , 'receiver_id' , 'sender_type' , 'receiver_type' , 'content' , 'seen'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')
            ->singleFile(); // Optionally, restrict to a single file per collection

    }
}
