<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_id', 'bill_amount','pay_amount','due_amount','bill_status'
    ];

}
