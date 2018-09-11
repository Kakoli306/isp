<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billings';
    protected $primaryKey = 'id';
    protected $guraded = ['id'];

    protected $fillable = [
        'customer_id','userId','incomeId', 'payment_amount','discount','payment_description','month'
    ];

}
