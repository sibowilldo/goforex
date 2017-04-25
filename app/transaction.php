<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'transactionAccepted',
        'cardHolderIpAddr',
        'requestTrace',
        'reference',
        'extra1',
        'extra2',
        'extra3',
        'amount',
        'm10',
        'method',
        'reason'
    ];
    
    // A Transaction belongsTo a User
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // A Transaction belongsTo an Event
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // A Transaction belongsTo a Booking
    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
}
