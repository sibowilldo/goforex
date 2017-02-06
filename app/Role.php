<?php

namespace App;
use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Role belongsToMany Permission
    public function permission()
    {
        return $this->belongsToMany('App\Permission');
    }

    // Role belongsToMany User
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    // Assign Permission to Role
    public function givePermissionTo(Permission $permission)
    {
        return $this->permission()->sync($permission);
    }
}
