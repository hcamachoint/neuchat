<?php

namespace App\Models;
use DB;
use Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';
    public $timestamps = true;

    use SoftDeletes,Notifiable,HasApiTokens;

    protected $dates = ['deleted_at'];
    protected $fillable = array('idn', 'name', 'name2', 'sex', 'nationality', 'image', 'image_path', 'email', 'password', 'company', 'url', 'confirmed');

    public static function CheckBan()
    {
        return DB::table('banneds')->where('user_id', '=', Auth::id())->where('lifted', '=', Null)->where('expires', '>=', Carbon::now())->exists();
    }

    public static function CheckConf()
    {
      return $this->confirmed = 1;
    }

    public function isAdmin()
    {
        foreach ($this->role()->get() as $role)
        {
            if ($role->slug == 'admin')
            {
                return true;
            }
        }

        return false;
    }

    /*public function is($roleName)
    {
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }*/

    public function briefcase()
    {
        return $this->hasMany('App\Models\Briefcase');
    }

    public function contact()
    {
        return $this->morphMany('App\Models\Contact', 'contactable');
    }

    public function attempts()
    {
        return $this->hasMany('App\Models\LoginAttempts');
    }

    public function ability()
    {
        return $this->morphMany('App\Models\Ability', 'abilityable');
    }

    public function education()
    {
        return $this->hasMany('App\Models\Education');
    }

    public function experience()
    {
        return $this->hasMany('App\Models\Experience');
    }

    public function work()
    {
        return $this->hasMany('App\Models\Work');
    }

    public function role()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function chat()
    {
        return $this->belongsToMany('App\Models\Chat');
    }

    public function location()
    {
        return $this->morphOne('App\Models\Location', 'locationable');
    }

    public function document()
    {
        return $this->morphMany('App\Models\Document', 'documentable');
    }

    public function social()
    {
        return $this->hasMany('App\Models\Social', 'user_id','id');
    }

    public function feedback()
    {
        return $this->hasMany('App\Models\Feedback', 'id', 'user_id');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }

    public function receivers() {
        return $this->hasMany('App\Models\Receiver');
    }

}
