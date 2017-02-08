<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'cell',
        'reference',
        'status_is',
        'location',
        'verified',
        'code',
        'sponsor',
    ];

    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'Inactive' => 'Inactive',
        'Active' => 'Active',
        'Blocked' => 'Blocked',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // A User belongsToMany Role
    public function role()
    {
        return $this->belongsToMany('App\Role');
    }

    // Find out if A User has Role
    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->role->contains('name', $role);
        }

        return !! $role->intersect($this->role)->count();
    }

    // Assign Role to A User
    public function actAs($role)
    {
        return $this->role()->save(
            Role::whereName($role)->firstOrFail()
        );
    }


    // A User has many Bookings
    public function booking()
    {
        return $this->hasMany('App\Booking');
    }

    // A User has many Events
    public function event()
    {
        return $this->hasMany('App\Events');
    }
}
