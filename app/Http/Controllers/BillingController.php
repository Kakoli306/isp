<?php

namespace App\Http\Controllers;

use App\Billing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function add(){

        $customers  = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->orderBy('id', 'DESC')->paginate(8);

        return view('superadmin.billing.add',['customers'=> $customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function editBilling($id){


        $BillingById = Customer::where('id',$id)->first();

       //For Auth->user->name
        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        $bills = Billing::where('customer_id',$id)->get();

// For dues
        $dues = DB::table('customers')
              ->join('billings','billings.customer_id', '=', 'customers.id')
              ->select('billings.*','customers.*')
            ->where('billings.customer_id','=',$id)
        ->count('bill_amount');

        $new = 0;

        if($dues > 0) {

            $bill_amount=0;

            $due = DB::table('customers')
                ->join('billings','billings.customer_id', '=', 'customers.id')
                ->select('billings.*','customers.*')
                ->where('billings.customer_id','=',$id)
                ->first();


            $connection_charge = $due->connection_charge;
            $month_amount = $due->month_amount;
            $new = ($bill_amount + $connection_charge - $month_amount);
        }

        else
        {
            $due = DB::table('customers')
                ->where('id',$id)
                ->first();
        }

        return view('superadmin.billing.edit',compact('BillingById','bills','users','date','new'));
    }

    public function adding(Request $request)
    {

        $billings = new Billing();
        $billings->customer_id = $request->id;
        $billings->userId = Auth::user()->userId;
        $billings->payment_amount = $request->payment_amount;
        $billings->discount = $request->discount;
        $billings->payment_description = $request->payment_description;
        $billings->month = Carbon::now();
        $billings->save();
        return redirect()->back()->with('message', 'Billing info saved ');
    }

    public function editAmount($id){
        $bills = Billing::where('id',$id)->first();
        return view('superadmin.billing.amountedit',compact('bills'));
    }
    public function updateBilling(Request $request )
    {
        $billings = Billing::find($request->billing_id);
        $billings->payment_amount = $request->payment_amount;
        $billings->save();

        return redirect()->back()->with('message', 'Billing info updated successfully ');
    }


    public function deleteBilling( Request $request)
    {
        $billings = Billing::find($request->billing_id);
        $billings->delete();

        return redirect()->back()->with('message',' deleted successfully');

    }

    public function discount(){

        $customers = DB::table('billings')
            ->join('customers', 'billings.customer_id', '=', 'customers.id')
            ->select('billings.*', 'customers.customer_name')
        ->get();

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        return view ('superadmin.billing.discount',compact( 'customers','users'));
    }


    public function lifetime_paid($BillingById) {

        DB::table('payments')->where('customer_id',$BillingById->id)->sum('pay_amount');
        return redirect('/customer/manage')->with('message', 'this guy is  unactive now');
    }


    public function paid(Request $request){

        $billings = Customer::where('id',$request->id)->first();
        $billings->bill_status = 0;
        $billings->save();
        return redirect()->back();
    }

    public function unpaid(Request $request){

        $billings = Customer::where('id',$request->id)->first();
        $billings->bill_status = 1;
        $billings->save();
        return redirect()->back();
    }


}
