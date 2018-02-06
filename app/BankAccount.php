<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'bank',
        'account_number',
        'branch',
        'account_holder',
        'status_is',
    ];


    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'active' => 'active',
        'inactive' => 'inactive',
    ];


    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $banks = [
        'First National Bank' => 'First National Bank',
        'Standard Bank' => 'Standard Bank',
        'NedBank' => 'NedBank',
        'Capitec' => 'Capitec',
        'ABSA' => 'ABSA',
    ];




    public function event()
    {
        return $this->hasMany('App\Event');
    }
}
