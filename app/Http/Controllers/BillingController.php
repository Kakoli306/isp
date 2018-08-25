<?php

namespace App\Http\Controllers;

use App\Billing;
use Illuminate\Http\Request;
use App\Customer;


class BillingController extends Controller
{
    public function add(){
        $customers = Customer::all();
        //dd($customers);
        return view('superadmin.billing.add',['customers'=> $customers]);
    }

   /* public function editBilling($customer_id)
    {
        $BillingById = Customer::where('id', '=',$customer_id)->get();
        return view('superadmin.billing.edit',['BillingById'=> $BillingById, 'id'=>$customer_id ]);
    }*/


    public function editBilling($id){
        // dd($id);
        $BillingById = Customer::where('id',$id)->first();
        // dd($BillingById);
        return view('superadmin.billing.edit',compact('BillingById'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $customer_id)
    {
        $billings = new Billing();
        $billings->customer_id = $customer_id;
        $billings->bill_status = 0;
        $billings->payment_amount = $request->payment_amount;
        $billings->discount = $request->discount;
        $billings->payment_description = $request->payment_description;
        $billings->save();
        return redirect('superadmin.billing.edit/{$customer_id}')->with('message', 'Billing info saved ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $passport= \App\Passport::find($id);
        $passport->name=$request->get('name');
        $passport->email=$request->get('email');
        $passport->number=$request->get('number');
        $passport->office=$request->get('office');
        $passport->save();
        return redirect('passports');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
