<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'type_is',
        'rate_is',
        'category_is',
        'status_is',
        'image',
        'featured',
        'url',
    ];

    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'Unpublished' => 'Unpublished',
        'Published' => 'Published',
    ];

    /**
     * The array of $rates.
     *
     * @var array
     */
    public static $rates = [
        'Item' => 'Per item',
        'Hour' => 'Per hour',
        'Litre' => 'Per litre',
        'Metre' => 'Per metre(m)',
        'Kilometre' => 'Per kilo metre (km)',
        'Squaremetre' => 'Per square metre (m2)',
        'Gram' => 'Per gram (g)',
        'Kilogram' => 'Per kilo gram (kg)',
    ];

    /**
     * The array of $categories.
     *
     * @var array
     */
    public static $categories = [
        'Business' => 'Business',
        'Finance' => 'Finance',
        'Branding' => 'Branding',
        'Internet' => 'Internet',
    ];

    /**
     * The array of $types.
     *
     * @var array
     */
    public static $types = [
        'Product' => 'Product',
        'Service' => 'Service',
    ];

    // Item belongsToMany Invoice
    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'invoice_item');
    }
}
