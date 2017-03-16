<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'reference_number',
        'message',
        'viewed',
        'type',
    ];

    protected $connection = 'mysql2';

    public $incrementing = false;
}