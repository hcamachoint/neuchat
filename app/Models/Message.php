<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message','file_path','file_name','type'];

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function receivers() {
        return $this->hasMany('App\Models\Receiver');
    }
}
