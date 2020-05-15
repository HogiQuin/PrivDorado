<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'uri_file',
        'payment_status_id',
        'payment_type_id',
        'created_by',
        'authorized_by'
    ];
}
