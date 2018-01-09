<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model 
{

    protected $table = 'files';
    public $timestamps = true;
    protected $fillable = array('name', 'type', 'url', 'fileable_id', 'fileable_type');

    public function fileable()
    {
        return $this->morphTo();
    }

}