<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'product_id', 'amount','account_details','userId'
    ];

}
