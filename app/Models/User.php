<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    public function views()
    {
        return $this->hasMany(Views::class);
    }
    public function Comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function Shares()
    {
        return $this->hasMany(Shares::class);
    }
}
