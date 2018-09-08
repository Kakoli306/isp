<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';


    protected $fillable = [
        'customer_name', 'mobile_no', 'email','blood_group','national_id','occupation','address','zone_id','month_amount',
        'connection_charge','ip_address','connection_date','speed','status','bill_status'
    ];



}
