<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function postsCategory()
    {
        return $this->hasMany(PostCategory::class);
    }

    // One to Many Relishanship to Likes Table



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    public function views()
    {
        return $this->hasMany(Views::class);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function shares()
    {
        return $this->hasMany(Shares::class);
    }
}
