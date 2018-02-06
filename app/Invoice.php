<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_is',
        'user_id',
        'discount',
        'amount',
        'notes',
    ];

    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'Pending' => 'Pending',
        'Paid' => 'Paid',
        'Processing' => 'Processing',
        'On-hold' => 'On-hold',
    ];

    // Invoice belongsToMany Item
    public function items()
    {
        return $this->belongsToMany('App\Item', 'invoice_item')
            ->withPivot('quantity', 'price');
    }

    // Invoice belongsToMany Item
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
