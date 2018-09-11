<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $fillable = ['name','price','userId','product_id','date'];

}
