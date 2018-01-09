<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
	protected $fillable = ['user_id'];


    public function user() 
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function message() 
    {
    	return $this->belongsTo('App\Models\Message');
    }
}
