<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_name', 'mobile_no', 'email','blood_group','national_id','occupation','address','zone_id','month_amount','bill_amount',
        'connection_charge','ip_address','connection_date','speed','status'
    ];
    public function Billing()
    {
        return $this->hasOne('App\Billing');
    }
}
