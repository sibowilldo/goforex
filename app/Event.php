<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'reference',
        'name',
        'host',
        'address',
        'description',
        'number_of_seats',
        'start_date',
        'end_date',
        'status_is',
    ];


    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'FullyBooked' => 'FullyBooked',
        'Open' => 'Open',
        'Closed' => 'Closed',
    ];
}
