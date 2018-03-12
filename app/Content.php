<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

  	protected $fillable = [
        'content',
    ];

    protected $hidden = [
        'note_id', 'created_at', 'updated_at'
    ];

    public function user()
    {
    	return $this->belongsTo(Note::class, 'note_id');	
    }
}
