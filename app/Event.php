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
        'attendees',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status_is',
    ];


    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'FullyBooked' => 'FullyBooked',
        'Pending' => 'Pending',
        'Open' => 'Open',
        'Closed' => 'Closed',
    ];

    // A Booking belongsTo User
    public function user()
    {
        return $this->belongsTo('App\User');
    }



}
