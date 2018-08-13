<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(){

        return view('superadmin.customer.createCustomer');

    }

    public function save( Request $request){

        $customers = new Customer();
        $customers->customer_name = $request->customer_name;
        $customers->mobile_no = $request->mobile_no;
        $customers->email = $request->email;
        $customers->blood_group = $request->blood_group;
        $customers->national_id = $request->national_id;
        $customers->occupation = $request->occupation;
        $customers->address = $request->address;
        $customers->zone = $request->zone;
        $customers->month_amount = $request->month_amount;
        $customers->bill_amount = $request->bill_amount;
        $customers->connection_charge = $request->connection_charge;
        $customers->ip_address = $request->ip_address;
        $customers->connection_date = $request->connection_date;
        $customers->speed = $request->speed;
        $customers->status = $request->status;

        $customers->save();
        return redirect("customer/create")->with('message', 'Customer info saved ');
    }


    public function zone(){
        return view('superadmin.zone');
    }
}
