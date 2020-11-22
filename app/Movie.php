<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";
    protected $fillable = ['title','year','director','poster','rented','synopsis'];
    protected $hidden = ['created_at','updated_at'];
}
