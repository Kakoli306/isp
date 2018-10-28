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
    public function add()
    {

        $customers = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->orderBy('customers.id', 'ASC')->paginate(8);

        $zones = DB::table('zones')->get();

        return view('superadmin.billing.add',['customers'=> $customers,'zones'=>$zones])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function editBilling($id){

        $BillingById = Customer::where('id',$id)->first();
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

        return view('superadmin.billing.edit',compact('BillingById','bills','users','date','ExpById'));
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
        $billings->dmon = Carbon::now()->format('M -Y');
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
            ->orderBy('id', 'DESC')->paginate(8);

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        return view ('superadmin.billing.discount',compact( 'customers','users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function lifetime_paid($BillingById) {

        DB::table('payments')->where('customer_id',$BillingById->id)->sum('pay_amount');
        return redirect('/customer/manage')->with('message', 'this guy is  unactive now');
    }


    public function paid(Request $request){

        $customers = Customer::where('id',$request->id)->first();
        $customers->bill_status = 0;
        $customers->save();
        return redirect()->back();
    }

    public function unpaid(Request $request){

        $customers = Customer::where('id',$request->id)->first();
        $customers->bill_status = 1;
        $customers->save();
        return redirect()->back();
    }

    public function showBilling($id)
    {

        $BillingById = Customer::where('id', $id)->first();
        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId', Auth::user()->userId)
            ->first();
        $bills = Billing::where('customer_id',$id)->get();

        return view('superadmin.billing.show', compact('BillingById', 'users','bills'));

    }


}
