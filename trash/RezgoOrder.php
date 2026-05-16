<?php

namespace Botble\RezgoConnector\Models;

use Illuminate\Database\Eloquent\Model;

class RezgoOrder extends Model
{
    protected $table = 'rezgo_orders';

    protected $fillable = [
        'customer_id',
        'rezgo_uid',
        'rezgo_title',
        'tour_date',
        'price_adult',
        'price_child',
        'qty_adult',
        'qty_child',
        'total',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'rezgo_booking_id',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(\Botble\Ecommerce\Models\Customer::class, 'customer_id');
    }
}
