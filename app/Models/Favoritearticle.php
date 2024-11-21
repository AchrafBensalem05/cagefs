<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoritearticle extends Model
{
    use HasFactory;
    protected $fillable = ['article_id', 'user_id' , 'type'];


    public function patient()
    {
        return $this->belongsTo(Patient::class , 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class , 'article_id');
    }


}
