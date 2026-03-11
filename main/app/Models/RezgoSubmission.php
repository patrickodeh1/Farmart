<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RezgoSubmission extends Model
{
    protected $table = 'rezgo_submissions';
    
    protected $fillable = [
        'order_id',
        'rezgo_booking_id',
        'status',
        'request_payload',
        'response_payload',
        'http_status',
        'error_message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'http_status' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
