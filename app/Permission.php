<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // Permission belongsToMany Role
    public function role()
    {
        return $this->belongsToMany('App\Role');
    }
}
