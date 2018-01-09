<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserChat extends Model 
{

    protected $table = 'user_chat';
    public $timestamps = true;
    protected $fillable = array('user_id', 'chat_id');

}