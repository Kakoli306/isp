<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $table = 'users';
    protected $primaryKey = 'userId';



    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'user_permission', 'user_id','permission_id');
    }

    public function hasAnyPermission($permissions)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($this->hasPermission($permission)) {
                    return true;
                }
            }
        } else {
            if ($this->hasPermission($permissions)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        if ($this->permissions()->where('name', $permission)->first()) {
            return true;
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password',  'username', 'address', 'phone','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];










}
