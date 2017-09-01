<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'firstname',
        'lastname',
        'contact_number',
        'branch',
        'image_path',
        'image',
        'status_is',
    ];

    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $branches = [
        'Durban' => 'Durban',
        'JHB' => 'JHB',
        'Sandton' => 'Sandton',
        'Mpumalanga' => 'Mpumalanga',
        'Pretoria' => 'Pretoria',
        'Empangeni' => 'Empangeni',
        'Limpopo' => 'Limpopo',
    ];
    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'Active' => 'Active',
        'Inactive' => 'Inactive',
        'Blocked' => 'Blocked',
    ];

}
