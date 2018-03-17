<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title', 'slug', 'type',
    ];


    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');	
    }


    public function getContentAttribute($value)
    {
        return json_decode($value);
    }


    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function getUserIdAttribute($value)
    {
        return (int) $value;
    }
}
