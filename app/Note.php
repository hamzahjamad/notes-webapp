<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'type',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');	
    }


    public function getContentAttribute($value)
    {
        return json_decode($value);
    }
}
